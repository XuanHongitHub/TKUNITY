@extends('layouts.app')

@section('title', ($post->seo_title ?? $post->title) . ' - ' . setting('site_name', 'TKUnity'))
@section('meta_description', $post->seo_description ?? \Illuminate\Support\Str::limit(strip_tags($post->getRawOriginal('content') ?? $post->content ?? ''), 160))
@section('header_class', 'header-solid')
@section('body_class', 'news-article')

@section('head')
    <link rel="stylesheet" href="{{ asset('mockups/ver4/news.css') }}">
@endsection

@section('content')
    <!-- Article Header -->
    @php
        $content = $post->getRawOriginal('content') ?? $post->content ?? '';
        $featuredImageUrl = $post->getFirstMediaUrl('thumbnail');
        $featuredImagePath = $featuredImageUrl ? parse_url($featuredImageUrl, PHP_URL_PATH) : null;

        if (!$featuredImagePath || !file_exists(public_path(urldecode($featuredImagePath)))) {
            $featuredImagePath = '/images/home/hero.png';
        }

        $authorName = $post->author?->name ?? setting('site_name', 'TKUnity');
        $authorInitials = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(preg_replace('/[^A-Za-z0-9]+/', '', $authorName), 0, 2));
        $excerpt = $post->seo_description ?: \Illuminate\Support\Str::limit(strip_tags($content), 200);
    @endphp

    <header class="article-header">
        <div class="article-meta-top">
            <span class="article-category">{{ $post->category?->name ?? 'Updates' }}</span>
            <span class="article-date">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                    <line x1="16" y1="2" x2="16" y2="6"/>
                    <line x1="8" y1="2" x2="8" y2="6"/>
                    <line x1="3" y1="10" x2="21" y2="10"/>
                </svg>
                {{ optional($post->published_at)->format('F d, Y') ?? $post->created_at->format('F d, Y') }}
            </span>
        </div>
        <h1>{{ $post->title }}</h1>
        <p class="article-excerpt">{{ $excerpt }}</p>
        <div class="article-author">
            <div class="author-avatar">{{ $authorInitials ?: 'TK' }}</div>
            <div class="author-info">
                <h4>{{ $authorName }}</h4>
                <span>{{ $post->category?->name ?? 'News' }}</span>
            </div>
        </div>
    </header>

    <!-- Featured Image -->
    <div class="article-featured-image" @if ($featuredImagePath) style="background-image: url('{{ $featuredImagePath }}'); background-size: cover; background-position: center;" @endif></div>

    <!-- Article Content -->
    <article class="article-content">
        {!! $content ?: '<p>Content is being updated. Please check back soon.</p>' !!}
    </article>

    <!-- Article Footer -->
    <footer class="article-footer">
        <div class="article-footer-content">
            <!-- Share Section -->
            <div class="share-section">
                <h3>Share this article</h3>
                <div class="share-links">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" rel="noopener noreferrer" class="share-link" aria-label="Facebook">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($post->title) }}" target="_blank" rel="noopener noreferrer" class="share-link" aria-label="X (Twitter)">
                        <svg viewBox="0 0 24 24" fill="currentColor">
                            <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                        </svg>
                    </a>
                    <a href="#" class="share-link" aria-label="Copy Link" data-copy-link>
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="9" y="9" width="13" height="13" rx="2" ry="2"/>
                            <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"/>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Newsletter -->
            <div class="newsletter-section">
                <h3>Stay Updated</h3>
                <p>Subscribe to our newsletter for platform updates and exclusive offers.</p>
                <form class="newsletter-form" data-newsletter>
                    <input type="email" placeholder="Enter your email" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </footer>

    <!-- Related News -->
    <section class="related-section">
        <div class="related-news">
            <div class="related-header">
                <h3>Related News</h3>
                <a href="{{ route('news.index') }}" wire:navigate class="related-link">View All →</a>
            </div>
            <div class="related-grid">
                @foreach ($relatedPosts as $related)
                    @php
                        $relatedImageUrl = $related->getFirstMediaUrl('thumbnail');
                        $relatedImagePath = $relatedImageUrl ? parse_url($relatedImageUrl, PHP_URL_PATH) : null;
                        
                        if (!$relatedImagePath || !file_exists(public_path(urldecode($relatedImagePath)))) {
                            $relatedImagePath = '/images/home/hero.png';
                        }
                    @endphp
                    <a href="{{ route('news.show', $related->slug) }}" wire:navigate class="related-card">
                        <div class="related-card-image" @if ($relatedImagePath) style="background-image: url('{{ $relatedImagePath }}'); background-size: cover; background-position: center;" @endif></div>
                        <span class="related-card-category">{{ $related->category?->name ?? 'Updates' }}</span>
                        <h4>{{ $related->title }}</h4>
                        <p>{{ \Illuminate\Support\Str::limit(strip_tags($related->getRawOriginal('content') ?? $related->content ?? ''), 100) }}</p>
                    </a>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Back Button -->
    <a href="{{ route('news.index') }}" wire:navigate class="back-button">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
            <polyline points="15 18 9 12 15 6"/>
        </svg>
        Back to News
    </a>
@endsection
