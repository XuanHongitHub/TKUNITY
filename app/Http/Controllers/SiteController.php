<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SiteController extends Controller
{
    public function home(): View
    {
        $featuredPost = Post::query()
            ->with('category')
            ->where('status', 'published')
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->first();

        if (! $featuredPost) {
            $featuredPost = Post::query()
                ->with('category')
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->first();
        }

        $latestPosts = Post::query()
            ->with('category')
            ->where('status', 'published')
            ->when($featuredPost, fn ($query) => $query->where('id', '!=', $featuredPost->id))
            ->orderByDesc('published_at')
            ->take(3)
            ->get();

        return view('pages.home', [
            'featuredPost' => $featuredPost,
            'latestPosts' => $latestPosts,
        ]);
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
    }

    public function careers(): View
    {
        return view('pages.careers');
    }

    public function login(): View
    {
        return view('pages.login');
    }

    public function submitContact(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'game' => 'nullable|string|max:255',
            'order' => 'nullable|string|max:255',
        ]);

        $nameParts = preg_split('/\s+/', trim($validated['full_name'])) ?: [];
        $firstName = $nameParts[0] ?? $validated['full_name'];
        $lastName = count($nameParts) > 1 ? implode(' ', array_slice($nameParts, 1)) : '';

        $extraLines = [];
        if (! empty($validated['game'])) {
            $extraLines[] = 'Game: ' . $validated['game'];
        }
        if (! empty($validated['order'])) {
            $extraLines[] = 'Order ID: ' . $validated['order'];
        }

        $message = $validated['message'];
        if ($extraLines) {
            $message .= "\n\n" . implode("\n", $extraLines);
        }

        Lead::create([
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $validated['email'],
            'subject' => $validated['subject'],
            'message' => $message,
            'source' => 'contact-form',
        ]);

        return back()->with('status', 'Thanks for reaching out. We will get back to you shortly.');
    }

    public function helpCenter(): View
    {
        return $this->renderPage('help-center', 'Help Center');
    }

    public function faqs(): View
    {
        return $this->renderPage('faqs', 'FAQs');
    }

    public function partners(): View
    {
        return $this->renderPage('partners', 'Partners');
    }

    public function terms(): View
    {
        return $this->renderPage('terms', 'Terms');
    }

    public function privacy(): View
    {
        return $this->renderPage('privacy', 'Privacy');
    }

    private function renderPage(string $code, string $fallbackTitle): View
    {
        $page = Page::query()
            ->where('is_active', true)
            ->where(function ($query) use ($code) {
                $query->where('code', $code)
                    ->orWhere('slug', $code);
            })
            ->first();

        return view('pages.static', [
            'page' => $page,
            'title' => $page?->title ?? $fallbackTitle,
            'content' => $page?->getRawOriginal('content') ?? $page?->content ?? null,
        ]);
    }
}
