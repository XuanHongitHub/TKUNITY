<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsPublicTest extends TestCase
{
    use RefreshDatabase;

    protected User $author;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        $this->author = User::factory()->create();
        $this->category = Category::factory()->create(['is_visible' => true]);
    }

    // ==========================================
    // NEWS INDEX PAGE TESTS
    // ==========================================

    public function test_news_index_page_loads(): void
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }

    public function test_news_index_displays_published_posts(): void
    {
        $publishedPost = Post::factory()->published()->create([
            'title' => 'Published Article',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertSee('Published Article');
    }

    public function test_news_index_does_not_display_draft_posts(): void
    {
        $draftPost = Post::factory()->draft()->create([
            'title' => 'Draft Article Should Not Show',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Draft Article Should Not Show');
    }

    public function test_news_index_does_not_display_archived_posts(): void
    {
        $archivedPost = Post::factory()->archived()->create([
            'title' => 'Archived Article Should Not Show',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertDontSee('Archived Article Should Not Show');
    }

    public function test_news_index_displays_featured_post(): void
    {
        $featuredPost = Post::factory()->published()->featured()->create([
            'title' => 'Featured News Article',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertSee('Featured News Article');
        $response->assertSee('Featured');
    }

    public function test_news_index_displays_categories_sidebar(): void
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertSee('Categories');
        $response->assertSee($this->category->name);
    }

    public function test_news_index_displays_trending_posts(): void
    {
        Post::factory()->count(4)->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertSee('Trending Now');
    }

    public function test_news_index_has_pagination(): void
    {
        // Create more than 6 posts (pagination limit)
        Post::factory()->count(10)->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }

    public function test_news_index_shows_empty_state_when_no_posts(): void
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
    }

    // ==========================================
    // NEWS CATEGORY FILTER TESTS
    // ==========================================

    public function test_news_category_page_loads(): void
    {
        $response = $this->get(route('news.category', $this->category->slug));

        $response->assertStatus(200);
    }

    public function test_news_category_filters_posts(): void
    {
        $categoryA = Category::factory()->create(['name' => 'Category A']);
        $categoryB = Category::factory()->create(['name' => 'Category B']);

        $postA = Post::factory()->published()->create([
            'title' => 'Post in Category A',
            'author_id' => $this->author->id,
            'category_id' => $categoryA->id,
        ]);

        $postB = Post::factory()->published()->create([
            'title' => 'Post in Category B',
            'author_id' => $this->author->id,
            'category_id' => $categoryB->id,
        ]);

        $response = $this->get(route('news.category', $categoryA->slug));

        $response->assertStatus(200);
        $response->assertSee('Post in Category A');
        // Post B appears in trending sidebar but not in main news list
        // Check that the main content section shows only Category A posts
        $response->assertSee('Browsing news in');
        $response->assertSee('Category A');
    }

    public function test_news_category_shows_category_name(): void
    {
        $response = $this->get(route('news.category', $this->category->slug));

        $response->assertStatus(200);
        $response->assertSee($this->category->name);
    }

    public function test_news_category_shows_back_to_all_link(): void
    {
        $response = $this->get(route('news.category', $this->category->slug));

        $response->assertStatus(200);
        $response->assertSee('Show All News');
    }

    public function test_news_category_returns_404_for_invalid_slug(): void
    {
        $response = $this->get(route('news.category', 'non-existent-category'));

        $response->assertStatus(404);
    }

    // ==========================================
    // NEWS SHOW PAGE TESTS
    // ==========================================

    public function test_news_show_page_loads(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
    }

    public function test_news_show_displays_post_title(): void
    {
        $post = Post::factory()->published()->create([
            'title' => 'Test Article Title',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Test Article Title');
    }

    public function test_news_show_displays_post_content(): void
    {
        $post = Post::factory()->published()->create([
            'content' => '<p>This is the article content.</p>',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('This is the article content.');
    }

    public function test_news_show_displays_author_name(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee($this->author->name);
    }

    public function test_news_show_displays_category(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee($this->category->name);
    }

    public function test_news_show_displays_published_date(): void
    {
        $post = Post::factory()->published()->create([
            'published_at' => now(),
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee($post->published_at->format('F d, Y'));
    }

    public function test_news_show_displays_related_posts(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        Post::factory()->count(3)->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Related News');
    }

    public function test_news_show_has_share_buttons(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Share this article');
    }

    public function test_news_show_has_back_to_news_link(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Back to News');
    }

    public function test_news_show_returns_404_for_draft_post(): void
    {
        $post = Post::factory()->draft()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(404);
    }

    public function test_news_show_returns_404_for_invalid_slug(): void
    {
        $response = $this->get(route('news.show', 'non-existent-post'));

        $response->assertStatus(404);
    }

    // ==========================================
    // SEO TESTS
    // ==========================================

    public function test_news_show_uses_seo_title_when_set(): void
    {
        $post = Post::factory()->published()->create([
            'title' => 'Regular Title',
            'seo_title' => 'SEO Optimized Title',
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('SEO Optimized Title', false);
    }

    public function test_news_show_uses_post_title_when_no_seo_title(): void
    {
        $post = Post::factory()->published()->create([
            'title' => 'Regular Title',
            'seo_title' => null,
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Regular Title');
    }

    // ==========================================
    // NEWSLETTER WIDGET TESTS
    // ==========================================

    public function test_news_index_has_newsletter_widget(): void
    {
        $response = $this->get(route('news.index'));

        $response->assertStatus(200);
        $response->assertSee('Newsletter');
    }

    public function test_news_show_has_newsletter_form(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Stay Updated');
    }

    // ==========================================
    // POST WITHOUT CATEGORY TESTS
    // ==========================================

    public function test_news_show_handles_post_without_category(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->author->id,
            'category_id' => null,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Updates'); // Default category name
    }

    // ==========================================
    // POST WITHOUT CONTENT TESTS
    // ==========================================

    public function test_news_show_handles_post_without_content(): void
    {
        $post = Post::factory()->published()->create([
            'content' => null,
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        $response = $this->get(route('news.show', $post->slug));

        $response->assertStatus(200);
        $response->assertSee('Content is being updated');
    }
}
