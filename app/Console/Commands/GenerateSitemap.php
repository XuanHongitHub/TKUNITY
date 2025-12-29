<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    protected $description = 'Generate the sitemap.';

    public function handle()
    {
        $path = public_path('sitemap.xml');
        
        $sitemap = \Spatie\Sitemap\Sitemap::create()
            ->add(\Spatie\Sitemap\Tags\Url::create('/'))
            ->add(\Spatie\Sitemap\Tags\Url::create('/about'))
            ->add(\Spatie\Sitemap\Tags\Url::create('/contact'));

        // Add Blog Posts
        \App\Models\Post::where('status', 'published')->each(function (\App\Models\Post $post) use ($sitemap) {
            $sitemap->add(
                \Spatie\Sitemap\Tags\Url::create("/blog/{$post->slug}")
                    ->setLastModificationDate($post->updated_at)
                    ->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.8)
            );
        });

        // Add Categories
        \App\Models\Category::where('is_visible', true)->each(function (\App\Models\Category $category) use ($sitemap) {
            $sitemap->add(
                \Spatie\Sitemap\Tags\Url::create("/category/{$category->slug}")
                    ->setLastModificationDate($category->updated_at)
                    ->setChangeFrequency(\Spatie\Sitemap\Tags\Url::CHANGE_FREQUENCY_WEEKLY)
                    ->setPriority(0.6)
            );
        });

        $sitemap->writeToFile($path);
        
        $this->info("Sitemap generated at {$path}");
    }
}
