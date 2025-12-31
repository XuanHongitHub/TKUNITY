<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
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

        $posts = Post::query()
            ->with('category')
            ->where('status', 'published')
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
        ]);
    }

    public function show(string $slug): View
    {
        $post = Post::query()
            ->with(['author', 'category'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        return view('pages.news-show', [
            'post' => $post,
        ]);
    }
}
