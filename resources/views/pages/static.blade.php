@extends('layouts.app')

@section('title', $title . ' - ' . setting('site_name', 'TKUnity'))
@section('meta_description', \Illuminate\Support\Str::limit(strip_tags($content ?? ''), 160))
@section('header_class', 'header-solid')

@section('head')
<style>
        /* Article Header */
        .article-header {
            position: relative;
            padding: 8rem 4rem 4rem;
            max-width: 900px;
            margin: 0 auto;
        }

        .article-meta-top {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .article-category {
            padding: 0.4rem 1rem;
            background: var(--accent);
            font-size: 0.7rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: white;
            border-radius: 4px;
        }

        .article-date {
            font-size: 0.8125rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 0.375rem;
        }

        .article-date svg {
            width: 14px;
            height: 14px;
        }

        .article-header h1 {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            line-height: 1.1;
            letter-spacing: -0.03em;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
        }

        .article-header h1 span {
            color: var(--accent);
        }

        .article-excerpt {
            font-size: 1.125rem;
            color: var(--text-muted);
            line-height: 1.7;
        }

        .article-author {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid var(--border);
        }

        .author-avatar {
            width: 48px;
            height: 48px;
            background: var(--accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            font-size: 1rem;
        }

        .author-info h4 {
            font-size: 0.9375rem;
            font-weight: 600;
        }

        .author-info span {
            font-size: 0.8125rem;
            color: var(--text-muted);
        }

        /* Article Content */
        .article-content {
            max-width: 740px;
            margin: 0 auto;
            padding: 4rem 2rem;
        }

        .article-content h2 {
            font-size: 1.75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
            margin-top: 3rem;
            margin-bottom: 1rem;
            color: var(--text);
        }

        .article-content h3 {
            font-size: 1.25rem;
            font-weight: 600;
            margin-top: 2rem;
            margin-bottom: 0.75rem;
            color: var(--text);
        }

        .article-content p {
            font-size: 1.0625rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 1.5rem;
        }

        .article-content ul,
        .article-content ol {
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
        }

        .article-content li {
            font-size: 1.0625rem;
            color: var(--text-muted);
            line-height: 1.8;
            margin-bottom: 0.5rem;
        }

        .article-content blockquote {
            border-left: 3px solid var(--accent);
            padding-left: 1.5rem;
            margin: 2rem 0;
            font-style: italic;
            font-size: 1.125rem;
            color: var(--text);
        }

        .article-content a {
            color: var(--accent);
            text-decoration: none;
            transition: opacity 0.2s;
        }

        .article-content a:hover {
            opacity: 0.7;
            text-decoration: underline;
        }

        /* Highlight Box */
        .highlight-box {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 12px;
            padding: 2rem;
            margin: 2rem 0;
        }

        .highlight-box.accent {
            border-color: var(--accent);
            background: rgba(220, 38, 38, 0.05);
        }

        .highlight-box h4 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            margin-bottom: 1rem;
        }

        .highlight-box p {
            font-size: 0.9375rem;
            margin-bottom: 0.5rem;
        }

        /* Prize Pool Banner */
        .prize-banner {
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            margin: 3rem auto;
            max-width: 740px;
        }

        .prize-amount {
            font-size: clamp(2.5rem, 6vw, 4rem);
            font-weight: 900;
            color: white;
            line-height: 1;
        }

        .prize-label {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: rgba(255, 255, 255, 0.8);
            margin-top: 0.5rem;
        }

        /* Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin: 2rem 0;
        }

        .info-card {
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1.5rem;
            text-align: center;
            transition: all 0.3s;
        }

        .info-card:hover {
            border-color: var(--accent);
            transform: translateY(-4px);
        }

        .info-card .icon {
            width: 48px;
            height: 48px;
            background: rgba(220, 38, 38, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            color: var(--accent);
        }

        .info-card .icon svg {
            width: 24px;
            height: 24px;
        }

        .info-card h4 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            margin-bottom: 0.5rem;
        }

        .info-card p {
            font-size: 0.9375rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        /* Game List */
        .game-list {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
            margin: 1.5rem 0;
        }

        .game-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            padding: 1rem;
            transition: all 0.3s;
        }

        .game-item:hover {
            border-color: var(--accent);
        }

        .game-icon {
            width: 48px;
            height: 48px;
            background: linear-gradient(135deg, var(--accent) 0%, var(--accent-dark) 100%);
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 700;
            color: white;
        }

        .game-info h4 {
            font-size: 0.9375rem;
            font-weight: 600;
        }

        .game-info p {
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0;
        }

        /* Article Footer */
        .article-footer {
            background: var(--bg-alt);
            border-top: 1px solid var(--border);
            padding: 4rem 2rem;
        }

        .article-footer-content {
            max-width: 740px;
            margin: 0 auto;
        }

        .share-section {
            text-align: center;
            margin-bottom: 3rem;
        }

        .share-section h3 {
            font-size: 0.875rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            margin-bottom: 1rem;
            color: var(--text-muted);
        }

        .share-links {
            display: flex;
            justify-content: center;
            gap: 0.75rem;
        }

        .share-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 8px;
            color: var(--text-muted);
            transition: all 0.3s;
        }

        .share-link:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .share-link svg {
            width: 18px;
            height: 18px;
        }

        /* Related News */
        .related-news {
            max-width: 1200px;
            margin: 0 auto;
        }

        .related-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid var(--border);
        }

        .related-header h3 {
            font-size: 1.25rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: -0.02em;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
        }

        .related-card {
            text-decoration: none;
            color: inherit;
            display: block;
            transition: transform 0.3s;
        }

        .related-card:hover {
            transform: translateY(-4px);
        }

        .related-card-image {
            aspect-ratio: 16/9;
            background: linear-gradient(135deg, var(--bg-alt) 0%, #1a1a1a 100%);
            border-radius: 8px;
            margin-bottom: 1rem;
            overflow: hidden;
        }

        .related-card-category {
            font-size: 0.65rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.1em;
            color: var(--accent);
            margin-bottom: 0.5rem;
        }

        .related-card h4 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            line-height: 1.4;
        }

        .related-card p {
            font-size: 0.8125rem;
            color: var(--text-muted);
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Newsletter */
        .newsletter-section {
            background: var(--accent);
            border-radius: 12px;
            padding: 3rem;
            text-align: center;
            margin: 4rem auto;
            max-width: 740px;
        }

        .newsletter-section h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: white;
            margin-bottom: 0.5rem;
        }

        .newsletter-section p {
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 2rem;
        }

        .newsletter-form {
            display: flex;
            gap: 1rem;
            max-width: 400px;
            margin: 0 auto;
        }

        .newsletter-form input {
            flex: 1;
            padding: 0.875rem 1rem;
            background: white;
            border: none;
            border-radius: 6px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.9375rem;
        }

        .newsletter-form button {
            padding: 0.875rem 1.5rem;
            background: var(--bg);
            color: white;
            border: none;
            border-radius: 6px;
            font-family: 'Space Grotesk', sans-serif;
            font-size: 0.8125rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            cursor: pointer;
            transition: all 0.3s;
        }

        .newsletter-form button:hover {
            background: var(--bg-alt);
        }

        /* Back Button */
        .back-button {
            position: fixed;
            bottom: 2rem;
            left: 2rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.25rem;
            background: var(--bg-elevated);
            border: 1px solid var(--border);
            border-radius: 50px;
            color: var(--text-muted);
            text-decoration: none;
            font-size: 0.8125rem;
            font-weight: 500;
            transition: all 0.3s;
            z-index: 50;
        }

        .back-button:hover {
            border-color: var(--accent);
            color: var(--accent);
        }

        .back-button svg {
            width: 16px;
            height: 16px;
        }

        /* Responsive */
        @media (max-width: 1100px) {
            .article-header,
            .article-content {
                padding-left: 2rem;
                padding-right: 2rem;
            }

            .related-grid {
                grid-template-columns: 1fr;
            }

            .game-list,
            .info-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 640px) {
            .article-header {
                padding: 7rem 1.5rem 3rem;
            }

            .article-content {
                padding: 2rem 1.5rem;
            }

            .article-header h1 {
                font-size: 1.75rem;
            }

            .prize-banner {
                padding: 2rem 1.5rem;
            }

            .info-grid,
            .game-list {
                grid-template-columns: 1fr;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .back-button {
                left: 1rem;
                bottom: 1rem;
            }
        }
</style>
@endsection

@section('content')
    <!-- Article Header -->
    @php
        $pageContent = $content ?? '';
        $authorName = setting('site_name', 'TKUnity');
        $authorInitials = \Illuminate\Support\Str::upper(\Illuminate\Support\Str::substr(preg_replace('/[^A-Za-z0-9]+/', '', $authorName), 0, 2));
    @endphp

    <header class="article-header">
        <div class="article-meta-top">
            <span class="article-category">Page</span>
            @if ($page?->updated_at)
                <span class="article-date">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    {{ $page->updated_at->format('F d, Y') }}
                </span>
            @endif
        </div>
        <h1>{{ $title }}</h1>
        <p class="article-excerpt">{{ \Illuminate\Support\Str::limit(strip_tags($pageContent), 200) }}</p>
        <div class="article-author">
            <div class="author-avatar">{{ $authorInitials ?: 'TK' }}</div>
            <div class="author-info">
                <h4>{{ $authorName }}</h4>
                <span>Support</span>
            </div>
        </div>
    </header>

    <!-- Article Content -->
    <article class="article-content">
        {!! $pageContent ?: '<p>Content is being updated. Please check back soon.</p>' !!}
    </article>
@endsection

@section('scripts')
<script>
        // No page-specific scripts needed
</script>
@endsection
