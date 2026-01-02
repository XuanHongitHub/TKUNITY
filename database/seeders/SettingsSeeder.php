<?php

namespace Database\Seeders;

use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);

        // Identity
        $settings->site_name = 'TK Unity';
        $settings->site_description = 'Official TK Unity platform for mobile games, AI training, and publishing.';

        // SEO
        $settings->seo_title = 'TK Unity';
        $settings->seo_description = 'Official TK Unity platform updates, products, and company information.';

        // Contact & Social
        $settings->contact_email = 'contact@tkunity.com';
        $settings->contact_phone = '0935 309 099';
        $settings->contact_address = 'Lot 01 A3 Nguyen Sinh Sac, Hoa Minh Ward, Lien Chieu District, Da Nang City, Vietnam';
        
        // Home - Hero
        $settings->home_hero_label = 'Architecting Virtual Worlds';
        $settings->home_hero_title = 'Innovation in <span class="accent">Every Pixel</span>';
        $settings->home_hero_subtitle = 'TK UNITY is a premier software development studio based in Da Nang. We fuse high-performance Unity game development with advanced AI solutions to create immersive digital experiences.';
        $settings->home_hero_cta_text = 'Explore Games';
        $settings->home_hero_cta_url = '/games';
        $settings->home_hero_cta2_text = 'AI Solutions';
        $settings->home_hero_cta2_url = '/ai-trainer';
        
        // Home - Focus Section
        $settings->home_focus_label = 'Our Focus';
        $settings->home_focus_title = 'Focused on <span class="accent">Impact</span>';
        $settings->home_focus_desc = "We don't chase trends. We build substantial technology that serves a purpose. Our bifurcated focus allows us to specialize deeply in two critical areas of the modern digital landscape.";
        $settings->home_focus_badge_label = 'Core Architecture';
        $settings->home_focus_badge_text = 'Dual-Engine Growth';

        // Home - Sections
        $settings->home_section_games_title = 'Crafting Digital <span class="accent">Worlds</span>';
        $settings->home_section_games_desc = 'We build mobile games that captivate millions. Using Unity\'s powerful engine, our team creates visually stunning, performance-optimized experiences for iOS and Android.';
        $settings->home_section_games_features = [
            'Cross-Platform Development',
            'High-Performance Optimization',
            'Data-Driven Game Design',
            'Live Operations & Updates'
        ];
        $settings->home_section_games_badge_label = 'Engine';
        $settings->home_section_games_badge_text = 'Unity';

        $settings->home_section_ai_title = 'Smart Fitness <span class="accent-green">Technology</span>';
        $settings->home_section_ai_desc = 'Our AI Personal Trainer uses advanced pose estimation and biomechanical analysis to provide real-time feedback that was previously only available to professional athletes.';
        $settings->home_section_ai_features = [
            'Real-Time Pose Tracking',
            'Form Correction Feedback',
            'Personalized Workout Plans',
            'Progress Analytics'
        ];
        $settings->home_section_ai_badge_label = 'Technology';
        $settings->home_section_ai_badge_text = 'Computer Vision';

        // Home - CTA Section
        $settings->home_cta_title = 'Technical Excellence.<br>Verified Integrity.';
        $settings->home_cta_desc = 'TK Unity adheres to strict industry standards. We provide transparent, high-performance software solutions for enterprise and government partners.';
        $settings->home_cta_btn1_text = 'Contact Our Team';
        $settings->home_cta_btn1_url = '/contact';
        $settings->home_cta_btn2_text = 'About Us';
        $settings->home_cta_btn2_url = '/about';

        // Handle Assets (Copy to storage so Filament can find them)
        $this->copyAsset('images/tkunity_red.webp', 'settings/site_logo.webp');
        $this->copyAsset('images/tkunity_white.webp', 'settings/logo_light.webp');
        $this->copyAsset('images/tkunity_dark.webp', 'settings/logo_dark.webp');
        $this->copyAsset('images/tkunity_red.webp', 'settings/logo_red.webp');
        $this->copyAsset('images/LOGO_ICON_TKUNITY.webp', 'settings/logo_icon.webp');
        $this->copyAsset('favicon.ico', 'settings/favicon.ico');
        $this->copyAsset('images/home/hero.png', 'settings/home_hero_bg.png');
        $this->copyAsset('images/home/focus.png', 'settings/home_focus_image.png');
        $this->copyAsset('images/home/games.png', 'settings/home_section_games_image.png');
        $this->copyAsset('images/home/ai-trainer.png', 'settings/home_section_ai_image.png');

        $settings->site_logo = 'settings/site_logo.webp';
        $settings->logo_light = 'settings/logo_light.webp';
        $settings->logo_dark = 'settings/logo_dark.webp';
        $settings->logo_red = 'settings/logo_red.webp';
        $settings->logo_icon = 'settings/logo_icon.webp';
        $settings->favicon = 'settings/favicon.ico';
        $settings->home_hero_bg = 'settings/home_hero_bg.png';
        $settings->home_focus_image = 'settings/home_focus_image.png';
        $settings->home_section_games_image = 'settings/home_section_games_image.png';
        $settings->home_section_ai_image = 'settings/home_section_ai_image.png';

        $settings->save();
    }

    private function copyAsset(string $source, string $dest): void
    {
        $sourcePath = public_path($source);
        if (file_exists($sourcePath)) {
            $storage = \Illuminate\Support\Facades\Storage::disk('public');
            if (!$storage->exists(dirname($dest))) {
                $storage->makeDirectory(dirname($dest));
            }
            $storage->put($dest, file_get_contents($sourcePath));
        }
    }
}
