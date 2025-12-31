@extends('layouts.site')

@section('title', 'News - ' . setting('site_name', 'TKUnity'))
@section('nav_variant', 'default')

@section('styles')
<style>

        /* Page Header */
        .page-header {
            position: relative;
            padding: 8rem 4rem 4rem;
            text-align: center;
            overflow: hidden;
        }

        .page-header::before {
            content: '';
            position: absolute;
            top: -50%;
            left: 50%;
            transform: translateX(-50%);
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, var(--accent-glow) 0%, transparent 60%);
            pointer-events: none;
        }

        .page-header-content {
            position: relative;
            z-index: 1;
            max-width: 700px;
            margin: 0 auto;
        }

        .page-header h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            line-height: 1;
            letter-spacing: -0.03em;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .page-header h1 span {
            color: var(--accent);
        }

        .page-header p {
            font-size: 1.0625rem;
            color: var(--text-muted);
        }

        /* News Container */
        .news-container {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 3rem;
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem 4rem 6rem;
        }

        /* Featured Post */
        .featured-post {
            text-decoration: none;
            color: inherit;
            display: block;
            margin-bottom: 3rem;
        }

        .featured-post-image {
            position: relative;
            aspect-ratio: 21/9;
            background: linear-gradient(135deg, var(--accent-glow) 0%, var(--bg-elevated) 50%, var(--bg-alt) 100%);
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 1.5rem;
        }

        .featured-post-image::before {
            content: 'FEATURED';
            position: absolute;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            font-weight: 900;
            letter-spacing: 0.2em;
            color: var(--accent);
            opacity: 0.15;
        }

        .featured-badge {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            padding: 0.5rem 1rem;
            background: var(--accent);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: white;
            border-radius: 4px;
        }

        .featured-post-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .featured-post-content h2 span {
            color: var(--accent);
        }

        .featured-post-content p {
            font-size: 1rem;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1rem;
        }

        .featured-post-meta {
            display: flex;
            align-items: center;
            gap: 1.5rem;
            font-size: 0.8125rem;
            color: var(--text-dim);
        }

        .featured-post-meta span {
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .featured-post-meta svg {
            width: 14px;
            height: 14px;
            color: var(--accent);
        }

        /* News List */
        .news-list-title {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--text-dim);
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .news-card {
            text-decoration: none;
            color: inherit;
            display: flex;
            gap: 1.5rem;
            padding: 1.5rem;
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.3s;
        }

        .news-card:hover {
            border-color: var(--accent);
            transform: translateX(4px);
        }

        .news-card-image {
            width: 180px;
            flex-shrink: 0;
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, var(--bg-elevated) 0%, #1a1a1a 100%);
            border-radius: 8px;
            overflow: hidden;
        }

        .news-card-content {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .news-card-category {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .news-card h3 {
            font-size: 1.125rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .news-card p {
            font-size: 0.875rem;
            color: var(--text-muted);
            line-height: 1.6;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            margin-bottom: 0.75rem;
        }

        .news-card-meta {
            margin-top: auto;
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 0.75rem;
            color: var(--text-dim);
        }

        /* Sidebar */
        .sidebar {
            position: sticky;
            top: 6rem;
            height: fit-content;
        }

        .sidebar-widget {
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .sidebar-widget h3 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1.25rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        /* Category List */
        .category-list {
            list-style: none;
        }

        .category-list li {
            margin-bottom: 0.5rem;
        }

        .category-list a {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.625rem 0.875rem;
            color: var(--text-muted);
            text-decoration: none;
            border-radius: 6px;
            transition: all 0.3s;
        }

        .category-list a:hover {
            background: var(--bg-elevated);
            color: var(--accent);
        }

        .category-list span {
            font-size: 0.75rem;
            background: var(--bg);
            padding: 0.125rem 0.5rem;
            border-radius: 50px;
        }

        /* Trending Posts */
        .trending-post {
            display: flex;
            gap: 0.75rem;
            padding: 0.75rem 0;
            border-bottom: 1px solid var(--border);
        }

        .trending-post:last-child {
            border-bottom: none;
        }

        .trending-number {
            font-family: 'JetBrains Mono', monospace;
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--accent);
            line-height: 1;
        }

        .trending-post-content h4 {
            font-size: 0.875rem;
            font-weight: 500;
            line-height: 1.4;
        }

        .trending-post-content span {
            font-size: 0.7rem;
            color: var(--text-dim);
        }

        /* Newsletter */
        .newsletter-widget {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border: none;
        }

        .newsletter-widget h3 {
            color: white;
            border-color: rgba(255, 255, 255, 0.2);
        }

        .newsletter-widget p {
            font-size: 0.8125rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1rem;
        }

        .newsletter-input {
            display: flex;
            gap: 0.5rem;
        }

        .newsletter-input input {
            flex: 1;
            padding: 0.625rem 0.875rem;
            background: white;
            color: #000;
            border: none;
            border-radius: 6px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.8125rem;
        }

        .newsletter-input button {
            padding: 0.625rem 1rem;
            background: var(--bg);
            border: none;
            border-radius: 6px;
            color: white;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            cursor: pointer;
        }

        /* Tags */
        .tags-cloud {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
        }

        .tag {
            padding: 0.375rem 0.75rem;
            background: var(--bg);
            border: 1px solid var(--border);
            border-radius: 50px;
            font-size: 0.75rem;
            color: var(--text-muted);
            text-decoration: none;
            transition: all 0.3s;
        }

        .tag:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        /* Pagination */
        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 3rem;
        }

        .pagination-btn {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-alt);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.875rem;
            transition: all 0.3s;
        }

        .pagination-btn:hover,
        .pagination-btn.active {
            background: var(--accent);
            border-color: var(--accent);
            color: white;
        }

        .pagination-btn svg {
            width: 16px;
            height: 16px;
        }


        /* Responsive */
        @media (max-width: 1100px) {
            .news-container {
                grid-template-columns: 1fr;
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .sidebar {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .page-header {
                padding: 7rem 1.5rem 3rem;
            }

            .news-container {
                padding: 2rem 1.5rem 4rem;
            }

            .featured-post h2 {
                font-size: 1.5rem;
            }

            .news-card {
                flex-direction: column;
            }

            .news-card-image {
                width: 100%;
            }
        }
</style>
@endsection

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-content">
            <h1>News & <span>Updates</span></h1>
            @if(isset($currentCategory))
                <p>Browsing news in <span>{{ $currentCategory->name }}</span></p>
                <div style="margin-top: 1rem;">
                    <a href="{{ route('news.index') }}" wire:navigate style="color: var(--accent); text-decoration: none; font-size: 0.8125rem;">← Show All News</a>
                </div>
            @else
                <p>Stay up to date with the latest from TKUnity - updates, promotions, and community highlights.</p>
            @endif
        </div>
    </section>

    <!-- News Container -->
    <div class="news-container">
        <!-- Main Content -->
        <main>
            <!-- Featured Post -->
            @if ($featuredPost)
                @php
                    $featuredImageUrl = $featuredPost->getFirstMediaUrl('thumbnail');
                    $featuredImagePath = $featuredImageUrl ? parse_url($featuredImageUrl, PHP_URL_PATH) : null;

                    if (!$featuredImagePath || !file_exists(public_path(urldecode($featuredImagePath)))) {
                        $featuredImagePath = '/images/home/landing_hero_bg.webp';
                    }
                @endphp
                <a href="{{ route('news.show', $featuredPost->slug) }}" wire:navigate class="featured-post">
                    <div class="featured-post-image" @if ($featuredImagePath) style="background-image: url('{{ $featuredImagePath }}'); background-size: cover; background-position: center;" @endif>
                        <span class="featured-badge">Featured</span>
                    </div>
                    <div class="featured-post-content">
                        <h2>{{ $featuredPost->title }}</h2>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($featuredPost->getRawOriginal('content') ?? $featuredPost->content ?? ''), 160) }}</p>
                        <div class="featured-post-meta">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                                    <line x1="16" y1="2" x2="16" y2="6"/>
                                    <line x1="8" y1="2" x2="8" y2="6"/>
                                    <line x1="3" y1="10" x2="21" y2="10"/>
                                </svg>
                                {{ optional($featuredPost->published_at)->format('M d, Y') ?? $featuredPost->created_at->format('M d, Y') }}
                            </span>
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                                </svg>
                                {{ $featuredPost->category?->name ?? 'Updates' }}
                            </span>
                        </div>
                    </div>
                </a>
            @endif

            <!-- News List -->
            <div class="news-list-title">Recent Articles</div>

            @forelse ($posts as $post)
                @php
                    $postImageUrl = $post->getFirstMediaUrl('thumbnail');
                    $postImagePath = $postImageUrl ? parse_url($postImageUrl, PHP_URL_PATH) : null;
                    
                    if (!$postImagePath || !file_exists(public_path(urldecode($postImagePath)))) {
                        $postImagePath = '/images/home/landing_hero_bg.webp';
                    }

                    $content = strip_tags($post->getRawOriginal('content') ?? $post->content ?? '');
                    $readMinutes = max(1, (int) ceil(str_word_count($content) / 200));
                @endphp
                <a href="{{ route('news.show', $post->slug) }}" wire:navigate class="news-card">
                    <div class="news-card-image" @if ($postImagePath) style="background-image: url('{{ $postImagePath }}'); background-size: cover; background-position: center;" @endif></div>
                    <div class="news-card-content">
                        <span class="news-card-category">{{ $post->category?->name ?? 'Updates' }}</span>
                        <h3>{{ $post->title }}</h3>
                        <p>{{ \Illuminate\Support\Str::limit($content, 150) }}</p>
                        <div class="news-card-meta">
                            <span>{{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                            <span>{{ $readMinutes }} min read</span>
                        </div>
                    </div>
                </a>
            @empty
                <p>No news articles yet.</p>
            @endforelse

            <!-- Pagination -->
            @if ($posts->hasPages())
                <div class="pagination">
                    @if ($posts->onFirstPage())
                        <span class="pagination-btn" aria-disabled="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </span>
                    @else
                        <a href="{{ $posts->previousPageUrl() }}" class="pagination-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="15 18 9 12 15 6"/>
                            </svg>
                        </a>
                    @endif

                    @foreach ($paginationLinks as $page => $url)
                        <a href="{{ $url }}" wire:navigate class="pagination-btn {{ $page === $posts->currentPage() ? 'active' : '' }}">{{ $page }}</a>
                    @endforeach

                    @if ($posts->hasMorePages())
                        <a href="{{ $posts->nextPageUrl() }}" class="pagination-btn">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </a>
                    @else
                        <span class="pagination-btn" aria-disabled="true">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="9 18 15 12 9 6"/>
                            </svg>
                        </span>
                    @endif
                </div>
            @endif
        </main>

        <!-- Sidebar -->
        <aside class="sidebar">
            <!-- Categories -->
            <div class="sidebar-widget">
                <h3>Categories</h3>
                <ul class="category-list">
                    @forelse ($categories as $category)
                        <li>
                            <a href="{{ route('news.category', $category->slug) }}" wire:navigate class="{{ isset($currentCategory) && $currentCategory->id === $category->id ? 'active' : '' }}">
                                <span>{{ $category->name }}</span>
                                <span>{{ $category->posts_count }}</span>
                            </a>
                        </li>
                    @empty
                        <li><span>No categories yet.</span></li>
                    @endforelse
                </ul>
            </div>

            <!-- Trending -->
            <div class="sidebar-widget">
                <h3>Trending Now</h3>
                @foreach ($trendingPosts as $index => $post)
                    <a href="{{ route('news.show', $post->slug) }}" wire:navigate class="trending-post" style="text-decoration: none; color: inherit; display: flex;">
                        <span class="trending-number">{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        <div class="trending-post-content">
                            <h4>{{ $post->title }}</h4>
                            <span>{{ optional($post->published_at)->format('M d, Y') ?? $post->created_at->format('M d, Y') }}</span>
                        </div>
                    </a>
                @endforeach
            </div>

            <!-- Newsletter -->
            <div class="sidebar-widget newsletter-widget">
                <h3>Newsletter</h3>
                <p>Get the latest news and updates delivered to your inbox.</p>
                <form class="newsletter-input" onsubmit="event.preventDefault(); alert('Subscribed!');">
                    <input type="email" placeholder="Your email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>

            <!-- Tags -->
            <div class="sidebar-widget">
                <h3>Popular Tags</h3>
                <div class="tags-cloud">
                    <a href="#" class="tag">update</a>
                    <a href="#" class="tag">topup</a>
                    <a href="#" class="tag">rewards</a>
                    <a href="#" class="tag">promotions</a>
                    <a href="#" class="tag">community</a>
                    <a href="#" class="tag">maintenance</a>
                    <a href="#" class="tag">support</a>
                    <a href="#" class="tag">payments</a>
                    <a href="#" class="tag">guides</a>
                </div>
            </div>
        </aside>
    </div>
@endsection
