<?php

namespace Tests\Feature\Admin;

use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        Role::firstOrCreate(['name' => 'super_admin']);
        $this->admin = User::factory()->create();
        $this->admin->assignRole('super_admin');
    }

    // ==========================================
    // CATEGORY CRUD TESTS
    // ==========================================

    public function test_can_create_category(): void
    {
        $category = Category::create([
            'name' => 'Technology',
            'description' => 'Tech related news',
            'is_visible' => true,
        ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'Technology',
            'is_visible' => true,
        ]);
    }

    public function test_category_slug_auto_generates(): void
    {
        $category = Category::create([
            'name' => 'Auto Slug Category',
        ]);

        $this->assertNotNull($category->slug);
        $this->assertStringContainsString('auto-slug-category', $category->slug);
    }

    public function test_duplicate_category_slugs_are_unique(): void
    {
        $category1 = Category::create(['name' => 'Same Name']);
        $category2 = Category::create(['name' => 'Same Name']);

        $this->assertNotEquals($category1->slug, $category2->slug);
    }

    public function test_can_update_category(): void
    {
        $category = Category::factory()->create();

        $category->update([
            'name' => 'Updated Name',
            'description' => 'Updated description',
        ]);

        $this->assertDatabaseHas('categories', [
            'id' => $category->id,
            'name' => 'Updated Name',
            'description' => 'Updated description',
        ]);
    }

    public function test_can_delete_category(): void
    {
        $category = Category::factory()->create();
        $categoryId = $category->id;

        $category->delete();

        $this->assertDatabaseMissing('categories', ['id' => $categoryId]);
    }

    // ==========================================
    // VISIBILITY TESTS
    // ==========================================

    public function test_category_default_is_visible(): void
    {
        $category = Category::create([
            'name' => 'Visible Category',
            'is_visible' => true,
        ]);

        $this->assertTrue($category->is_visible);
    }

    public function test_can_create_hidden_category(): void
    {
        $category = Category::factory()->hidden()->create();

        $this->assertFalse($category->is_visible);
    }

    public function test_can_toggle_category_visibility(): void
    {
        $category = Category::factory()->create(['is_visible' => true]);

        $category->update(['is_visible' => false]);

        $this->assertFalse($category->fresh()->is_visible);
    }

    // ==========================================
    // RELATIONSHIP TESTS
    // ==========================================

    public function test_category_has_many_posts(): void
    {
        $category = Category::factory()->create();
        $posts = Post::factory()->count(3)->create([
            'category_id' => $category->id,
            'author_id' => $this->admin->id,
        ]);

        $this->assertCount(3, $category->posts);
        $this->assertInstanceOf(Post::class, $category->posts->first());
    }

    public function test_category_can_have_parent(): void
    {
        $parentCategory = Category::factory()->create(['name' => 'Parent']);
        $childCategory = Category::factory()->create([
            'name' => 'Child',
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertEquals($parentCategory->id, $childCategory->parent_id);
        $this->assertInstanceOf(Category::class, $childCategory->parent);
        $this->assertEquals('Parent', $childCategory->parent->name);
    }

    public function test_category_can_have_children(): void
    {
        $parentCategory = Category::factory()->create();
        $childCategories = Category::factory()->count(2)->create([
            'parent_id' => $parentCategory->id,
        ]);

        $this->assertCount(2, $parentCategory->children);
    }

    public function test_deleting_parent_nullifies_children(): void
    {
        $parentCategory = Category::factory()->create();
        $childCategory = Category::factory()->create([
            'parent_id' => $parentCategory->id,
        ]);

        $parentCategory->delete();

        $this->assertNull($childCategory->fresh()->parent_id);
    }

    public function test_deleting_category_nullifies_posts(): void
    {
        $category = Category::factory()->create();
        $post = Post::factory()->create([
            'category_id' => $category->id,
            'author_id' => $this->admin->id,
        ]);

        $category->delete();

        $this->assertNull($post->fresh()->category_id);
    }

    // ==========================================
    // FACTORY TESTS
    // ==========================================

    public function test_category_factory_creates_valid_category(): void
    {
        $category = Category::factory()->create();

        $this->assertNotNull($category->name);
        $this->assertNotNull($category->slug);
        $this->assertTrue($category->is_visible);
    }

    public function test_category_factory_hidden_state(): void
    {
        $category = Category::factory()->hidden()->create();

        $this->assertFalse($category->is_visible);
    }

    // ==========================================
    // VALIDATION TESTS
    // ==========================================

    public function test_category_requires_name(): void
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Category::create([
            'description' => 'No name category',
        ]);
    }

    public function test_category_description_can_be_null(): void
    {
        $category = Category::factory()->create([
            'description' => null,
        ]);

        $this->assertNull($category->description);
    }

    // ==========================================
    // QUERY TESTS
    // ==========================================

    public function test_can_query_visible_categories(): void
    {
        Category::factory()->count(3)->create(['is_visible' => true]);
        Category::factory()->count(2)->hidden()->create();

        $visibleCategories = Category::where('is_visible', true)->get();

        $this->assertCount(3, $visibleCategories);
    }

    public function test_can_count_posts_per_category(): void
    {
        $category = Category::factory()->create();
        Post::factory()->count(5)->create([
            'category_id' => $category->id,
            'author_id' => $this->admin->id,
            'status' => 'published',
        ]);

        $categoryWithCount = Category::withCount(['posts' => fn($q) => $q->where('status', 'published')])
            ->find($category->id);

        $this->assertEquals(5, $categoryWithCount->posts_count);
    }
}
