<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(?string $categorySlug = null): View
    {
        $category = null;
        if ($categorySlug) {
            $category = Category::where('slug', $categorySlug)->firstOrFail();
        }

        $featuredPost = Post::query()
            ->with('category')
            ->where('status', 'published')
            ->when($category, fn($q) => $q->where('category_id', $category->id))
            ->where('is_featured', true)
            ->orderByDesc('published_at')
            ->first();

        if (! $featuredPost && ! $categorySlug) {
            $featuredPost = Post::query()
                ->with('category')
                ->where('status', 'published')
                ->orderByDesc('published_at')
                ->first();
        }

        $posts = Post::query()
            ->with('category')
            ->where('status', 'published')
            ->when($category, fn($q) => $q->where('category_id', $category->id))
            ->when($featuredPost, fn ($query) => $query->where('id', '!=', $featuredPost->id))
            ->orderByDesc('published_at')
            ->paginate(6);

        $current = $posts->currentPage();
        $last = $posts->lastPage();
        $start = max(1, $current - 1);
        $end = min($last, $current + 1);
        $paginationLinks = [];
        for ($page = $start; $page <= $end; $page++) {
            $paginationLinks[$page] = $posts->url($page);
        }

        $categories = Category::query()
            ->where('is_visible', true)
            ->withCount(['posts' => fn ($query) => $query->where('status', 'published')])
            ->orderByDesc('posts_count')
            ->take(8)
            ->get();

        $trendingPosts = Post::query()
            ->with('category')
            ->where('status', 'published')
            ->orderByDesc('published_at')
            ->take(4)
            ->get();

        return view('pages.news-index', [
            'featuredPost' => $featuredPost,
            'posts' => $posts,
            'paginationLinks' => $paginationLinks,
            'categories' => $categories,
            'trendingPosts' => $trendingPosts,
            'currentCategory' => $category,
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::query()
            ->with(['author', 'category'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $relatedPosts = Post::query()
            ->with(['category'])
            ->where('status', 'published')
            ->where('id', '!=', $post->id)
            ->where('category_id', $post->category_id)
            ->take(3)
            ->get();

        if ($relatedPosts->count() < 3) {
            $extraPosts = Post::query()
                ->with(['category'])
                ->where('status', 'published')
                ->where('id', '!=', $post->id)
                ->whereNotIn('id', $relatedPosts->pluck('id'))
                ->take(3 - $relatedPosts->count())
                ->get();
            $relatedPosts = $relatedPosts->concat($extraPosts);
        }

        return view('pages.news-show', [
            'post' => $post,
            'relatedPosts' => $relatedPosts,
        ]);
    }
}
