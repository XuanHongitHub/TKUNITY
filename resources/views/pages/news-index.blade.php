@extends('layouts.app')

@section('title', 'News - ' . setting('site_name', 'TKUnity'))
@section('header_class', 'header-solid')
@section('body_class', 'news-page')

@section('head')
    <link rel="stylesheet" href="{{ asset('mockups/ver4/news.css') }}">
@endsection

@section('content')

    <!-- Page Header -->
    <section class="page-header">
        <div class="page-header-content">
            <h1>News & <span>Updates</span></h1>
            @if(isset($currentCategory))
                <p>Browsing news in <span>{{ $currentCategory->name }}</span></p>
                <div class="news-reset">
                    <a href="{{ route('news.index') }}" wire:navigate class="news-reset-link">← Show All News</a>
                </div>
            @else
                <p>Stay up to date with the latest from TKUnity - updates, promotions, and community highlights.</p>
            @endif
        </div>
    </section>

    <!-- News Container -->
    <div class="news-container">
        <!-- Main Content -->
        <section class="news-main">
            <!-- Featured Post -->
            @if ($featuredPost)

                <a href="{{ route('news.show', $featuredPost->slug) }}" wire:navigate class="featured-post">
                    <div class="featured-post-image" style="background-image: url('{{ media_url($featuredPost, 'thumbnail', 'images/home/hero.png') }}'); background-size: cover; background-position: center;">
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

                    $content = strip_tags($post->getRawOriginal('content') ?? $post->content ?? '');
                    $readMinutes = max(1, (int) ceil(str_word_count($content) / 200));
                @endphp
                <a href="{{ route('news.show', $post->slug) }}" wire:navigate class="news-card">
                    <div class="news-card-image" style="background-image: url('{{ media_url($post, 'thumbnail', 'images/home/hero.png') }}'); background-size: cover; background-position: center;"></div>
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
        </section>

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
                    <a href="{{ route('news.show', $post->slug) }}" wire:navigate class="trending-post">
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
                <form class="newsletter-input" data-newsletter>
                    <input type="email" placeholder="Your email">
                    <button type="submit">Subscribe</button>
                </form>
            </div>


        </aside>
    </div>
@endsection
