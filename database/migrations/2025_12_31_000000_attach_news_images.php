<?php

use Illuminate\Database\Migrations\Migration;
use App\Models\Post;

return new class extends Migration
{
    public function up(): void
    {
        $mapping = [
            'getting-started-with-tkunity' => 'getting-started.png',
            'order-status-guide' => 'order-status.png',
            'supported-games-on-tkunity' => 'supported-games.png',
            'community-guidelines' => 'community.png',
        ];

        foreach ($mapping as $slug => $filename) {
            $post = Post::where('slug', $slug)->first();
            if ($post) {
                // Clear existing media to avoid duplicates
                $post->clearMediaCollection('thumbnail');
                
                $path = public_path('images/news/flat/' . $filename);
                if (file_exists($path)) {
                    $post->addMedia($path)
                        ->preservingOriginal()
                        ->toMediaCollection('thumbnail');
                }
            }
        }
    }

    public function down(): void
    {
        // No need to revert specifically, but we could clear media
    }
};
