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
        return view('pages.home');
    }

    public function about(): View
    {
        return view('pages.about');
    }

    public function contact(): View
    {
        return view('pages.contact');
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

    public function games(): View
    {
        return view('pages.games');
    }

    public function aiTrainer(): View
    {
        return view('pages.ai-trainer');
    }

    public function help(): View
    {
        return view('pages.help');
    }

    public function faqs(): View
    {
        return view('pages.faqs');
    }

    public function gamePublishing(): View
    {
        return view('pages.game-publishing');
    }

    public function enterpriseSolutions(): View
    {
        return view('pages.enterprise-solutions');
    }

    public function documentation(): View
    {
        return view('pages.documentation');
    }

    public function terms(): View
    {
        return view('pages.terms');
    }

    public function privacy(): View
    {
        return view('pages.privacy');
    }
}
