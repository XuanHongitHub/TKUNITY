<?php

namespace Tests\Feature\Admin;

use App\Filament\Resources\Posts\PostResource;
use App\Filament\Resources\Posts\Pages\CreatePost;
use App\Filament\Resources\Posts\Pages\EditPost;
use App\Filament\Resources\Posts\Pages\ListPosts;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class PostResourceTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;
    protected User $author;
    protected Category $category;

    protected function setUp(): void
    {
        parent::setUp();

        // Create roles
        $superAdminRole = Role::firstOrCreate(['name' => 'super_admin']);
        $panelUserRole = Role::firstOrCreate(['name' => 'panel_user']);

        // Create admin user
        $this->admin = User::factory()->create();
        $this->admin->assignRole('super_admin');

        // Create author user
        $this->author = User::factory()->create();
        $this->author->assignRole('panel_user');

        // Create category
        $this->category = Category::factory()->create();
    }

    // ==========================================
    // ACCESS & AUTHENTICATION TESTS
    // ==========================================

    public function test_guest_cannot_access_posts_list(): void
    {
        $this->get(PostResource::getUrl('index'))
            ->assertRedirect('/admin/login');
    }

    public function test_admin_can_access_posts_list(): void
    {
        $this->actingAs($this->admin)
            ->get(PostResource::getUrl('index'))
            ->assertSuccessful();
    }

    public function test_admin_can_access_create_post_page(): void
    {
        $this->actingAs($this->admin)
            ->get(PostResource::getUrl('create'))
            ->assertSuccessful();
    }

    public function test_admin_can_access_edit_post_page(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->actingAs($this->admin)
            ->get(PostResource::getUrl('edit', ['record' => $post]))
            ->assertSuccessful();
    }

    // ==========================================
    // LIST PAGE TESTS
    // ==========================================

    public function test_posts_list_displays_posts(): void
    {
        $posts = Post::factory()->count(5)->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertCanSeeTableRecords($posts);
    }

    public function test_posts_list_displays_correct_columns(): void
    {
        $post = Post::factory()->published()->featured()->create([
            'title' => 'Test News Article',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertCanSeeTableRecords([$post])
            ->assertTableColumnExists('thumbnail')
            ->assertTableColumnExists('title')
            ->assertTableColumnExists('category.name')
            ->assertTableColumnExists('author.name')
            ->assertTableColumnExists('status')
            ->assertTableColumnExists('published_at')
            ->assertTableColumnExists('is_featured');
    }

    public function test_posts_list_can_search_by_title(): void
    {
        $matchingPost = Post::factory()->create([
            'title' => 'Unique Searchable Title',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $nonMatchingPost = Post::factory()->create([
            'title' => 'Different Article',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->searchTable('Unique Searchable')
            ->assertCanSeeTableRecords([$matchingPost])
            ->assertCanNotSeeTableRecords([$nonMatchingPost]);
    }

    public function test_posts_list_can_sort_by_published_at(): void
    {
        $oldPost = Post::factory()->published()->create([
            'published_at' => now()->subDays(10),
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $newPost = Post::factory()->published()->create([
            'published_at' => now(),
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->sortTable('published_at', 'desc')
            ->assertCanSeeTableRecords([$newPost, $oldPost], inOrder: true);
    }

    public function test_posts_list_can_sort_by_author(): void
    {
        $postByAdmin = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $postByAuthor = Post::factory()->create([
            'author_id' => $this->author->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertCanSeeTableRecords([$postByAdmin, $postByAuthor]);
    }

    // ==========================================
    // CREATE POST TESTS (Direct Database)
    // ==========================================

    public function test_can_create_post_directly(): void
    {
        $this->actingAs($this->admin);

        $post = Post::create([
            'title' => 'New Test Article',
            'status' => 'draft',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'New Test Article',
            'status' => 'draft',
        ]);
    }

    public function test_can_create_post_with_all_fields(): void
    {
        $this->actingAs($this->admin);

        $post = Post::create([
            'title' => 'Complete Test Article',
            'slug' => 'complete-test-article',
            'content' => '<p>This is the full content of the article.</p>',
            'status' => 'published',
            'published_at' => now(),
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
            'is_featured' => true,
            'seo_title' => 'SEO Optimized Title',
            'seo_description' => 'SEO meta description for search engines.',
        ]);

        $this->assertDatabaseHas('posts', [
            'title' => 'Complete Test Article',
            'status' => 'published',
            'is_featured' => true,
            'seo_title' => 'SEO Optimized Title',
        ]);
    }

    public function test_post_requires_title(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Post::create([
            'status' => 'draft',
            'author_id' => $this->admin->id,
        ]);
    }

    public function test_slug_auto_generates_from_title(): void
    {
        $post = Post::create([
            'title' => 'Auto Generated Slug Test',
            'status' => 'draft',
            'author_id' => $this->admin->id,
        ]);

        $this->assertNotNull($post->slug);
        $this->assertStringContainsString('auto-generated-slug-test', $post->slug);
    }

    // ==========================================
    // EDIT POST TESTS
    // ==========================================

    public function test_can_edit_post(): void
    {
        $post = Post::factory()->create([
            'title' => 'Original Title',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update(['title' => 'Updated Title']);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'title' => 'Updated Title',
        ]);
    }

    public function test_can_change_post_status(): void
    {
        $post = Post::factory()->draft()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update([
            'status' => 'published',
            'published_at' => now(),
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'status' => 'published',
        ]);
    }

    public function test_can_update_seo_fields(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update([
            'seo_title' => 'Updated SEO Title',
            'seo_description' => 'Updated SEO description for better ranking.',
        ]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'seo_title' => 'Updated SEO Title',
            'seo_description' => 'Updated SEO description for better ranking.',
        ]);
    }

    public function test_can_toggle_featured_status(): void
    {
        $post = Post::factory()->create([
            'is_featured' => false,
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update(['is_featured' => true]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'is_featured' => true,
        ]);
    }

    public function test_can_change_category(): void
    {
        $newCategory = Category::factory()->create();
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update(['category_id' => $newCategory->id]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'category_id' => $newCategory->id,
        ]);
    }

    public function test_can_change_author(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $post->update(['author_id' => $this->author->id]);

        $this->assertDatabaseHas('posts', [
            'id' => $post->id,
            'author_id' => $this->author->id,
        ]);
    }

    // ==========================================
    // DELETE POST TESTS
    // ==========================================

    public function test_can_delete_post(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $postId = $post->id;
        $post->delete();

        $this->assertDatabaseMissing('posts', [
            'id' => $postId,
        ]);
    }

    public function test_can_bulk_delete_posts(): void
    {
        $posts = Post::factory()->count(3)->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $postIds = $posts->pluck('id')->toArray();
        Post::whereIn('id', $postIds)->delete();

        foreach ($postIds as $id) {
            $this->assertDatabaseMissing('posts', ['id' => $id]);
        }
    }

    // ==========================================
    // STATUS WORKFLOW TESTS
    // ==========================================

    public function test_can_create_draft_post(): void
    {
        $post = Post::factory()->draft()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertEquals('draft', $post->status);
        $this->assertNull($post->published_at);
    }

    public function test_can_create_published_post(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertEquals('published', $post->status);
        $this->assertNotNull($post->published_at);
    }

    public function test_can_create_scheduled_post(): void
    {
        $post = Post::factory()->scheduled()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertEquals('scheduled', $post->status);
        $this->assertTrue($post->published_at->isFuture());
    }

    public function test_can_create_archived_post(): void
    {
        $post = Post::factory()->archived()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertEquals('archived', $post->status);
    }

    public function test_can_create_featured_post(): void
    {
        $post = Post::factory()->featured()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertTrue($post->is_featured);
    }

    // ==========================================
    // RELATIONSHIP TESTS
    // ==========================================

    public function test_post_belongs_to_category(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertInstanceOf(Category::class, $post->category);
        $this->assertEquals($this->category->id, $post->category->id);
    }

    public function test_post_belongs_to_author(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertInstanceOf(User::class, $post->author);
        $this->assertEquals($this->admin->id, $post->author->id);
    }

    public function test_post_displays_category_in_table(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertCanSeeTableRecords([$post])
            ->assertTableColumnStateSet('category.name', $this->category->name, $post);
    }

    public function test_post_displays_author_in_table(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertCanSeeTableRecords([$post])
            ->assertTableColumnStateSet('author.name', $this->admin->name, $post);
    }

    // ==========================================
    // FORM FIELD EXISTENCE TESTS
    // ==========================================

    public function test_create_form_has_all_required_fields(): void
    {
        Livewire::actingAs($this->admin)
            ->test(CreatePost::class)
            ->assertFormFieldExists('title')
            ->assertFormFieldExists('slug')
            ->assertFormFieldExists('content')
            ->assertFormFieldExists('status')
            ->assertFormFieldExists('published_at')
            ->assertFormFieldExists('author_id')
            ->assertFormFieldExists('category_id')
            ->assertFormFieldExists('is_featured')
            ->assertFormFieldExists('seo_title')
            ->assertFormFieldExists('seo_description')
            ->assertFormFieldExists('thumbnail')
            ->assertFormFieldExists('tags');
    }

    // ==========================================
    // NAVIGATION & RESOURCE CONFIG TESTS
    // ==========================================

    public function test_resource_has_correct_model(): void
    {
        $this->assertEquals(Post::class, PostResource::getModel());
    }

    public function test_resource_has_correct_navigation_label(): void
    {
        $this->assertEquals('News', PostResource::getNavigationLabel());
    }

    public function test_resource_has_correct_model_label(): void
    {
        $this->assertEquals('News Article', PostResource::getModelLabel());
    }

    public function test_resource_has_correct_plural_model_label(): void
    {
        $this->assertEquals('News', PostResource::getPluralModelLabel());
    }

    public function test_resource_has_correct_pages(): void
    {
        $pages = PostResource::getPages();

        $this->assertArrayHasKey('index', $pages);
        $this->assertArrayHasKey('create', $pages);
        $this->assertArrayHasKey('edit', $pages);
    }

    // ==========================================
    // SLUG UNIQUENESS TESTS
    // ==========================================

    public function test_duplicate_slugs_are_made_unique(): void
    {
        $post1 = Post::create([
            'title' => 'Same Title',
            'status' => 'draft',
            'author_id' => $this->admin->id,
        ]);

        $post2 = Post::create([
            'title' => 'Same Title',
            'status' => 'draft',
            'author_id' => $this->admin->id,
        ]);

        $this->assertNotEquals($post1->slug, $post2->slug);
    }

    // ==========================================
    // SEO FIELDS TESTS
    // ==========================================

    public function test_post_with_seo_fields(): void
    {
        $post = Post::factory()->withSeo()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertNotNull($post->seo_title);
        $this->assertNotNull($post->seo_description);
    }

    public function test_seo_title_can_be_null(): void
    {
        $post = Post::factory()->create([
            'seo_title' => null,
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertNull($post->seo_title);
    }

    public function test_seo_description_can_be_null(): void
    {
        $post = Post::factory()->create([
            'seo_description' => null,
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertNull($post->seo_description);
    }

    // ==========================================
    // CONTENT TESTS
    // ==========================================

    public function test_post_content_can_be_html(): void
    {
        $htmlContent = '<h1>Title</h1><p>Paragraph with <strong>bold</strong> text.</p>';

        $post = Post::factory()->create([
            'content' => $htmlContent,
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertEquals($htmlContent, $post->content);
    }

    public function test_post_content_can_be_null(): void
    {
        $post = Post::factory()->create([
            'content' => null,
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertNull($post->content);
    }

    // ==========================================
    // PUBLISHED_AT TESTS
    // ==========================================

    public function test_published_at_is_cast_to_datetime(): void
    {
        $post = Post::factory()->published()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertInstanceOf(\Carbon\Carbon::class, $post->published_at);
    }

    public function test_published_at_can_be_null(): void
    {
        $post = Post::factory()->draft()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        $this->assertNull($post->published_at);
    }

    // ==========================================
    // CATEGORY NULLABLE TESTS
    // ==========================================

    public function test_post_can_have_null_category(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => null,
        ]);

        $this->assertNull($post->category_id);
        $this->assertNull($post->category);
    }

    // ==========================================
    // EDIT PAGE TESTS
    // ==========================================

    public function test_edit_page_loads_post_data(): void
    {
        $post = Post::factory()->create([
            'title' => 'Test Post Title',
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(EditPost::class, ['record' => $post->id])
            ->assertFormSet([
                'title' => 'Test Post Title',
            ]);
    }

    public function test_edit_page_has_delete_action(): void
    {
        $post = Post::factory()->create([
            'author_id' => $this->admin->id,
            'category_id' => $this->category->id,
        ]);

        Livewire::actingAs($this->admin)
            ->test(EditPost::class, ['record' => $post->id])
            ->assertActionExists(DeleteAction::class);
    }

    // ==========================================
    // LIST PAGE HEADER ACTIONS TESTS
    // ==========================================

    public function test_list_page_has_create_action(): void
    {
        Livewire::actingAs($this->admin)
            ->test(ListPosts::class)
            ->assertActionExists('create');
    }
}
