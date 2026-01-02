<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Identity


        // Contact & Social
        $this->migrator->add('general.contact_email', 'contact@tkunity.com');
        $this->migrator->add('general.contact_phone', '+84 123 456 789');
        $this->migrator->add('general.contact_address', 'Da Nang, Vietnam');
        $this->migrator->add('general.social_facebook', null);
        $this->migrator->add('general.social_twitter', null);
        $this->migrator->add('general.social_linkedin', null);
        $this->migrator->add('general.social_youtube', null);

        // Home - Hero
        $this->migrator->add('general.home_hero_label', 'Architecting Virtual Worlds');
        $this->migrator->add('general.home_hero_title', 'Innovation in <span class="accent">Every Pixel</span>');
        $this->migrator->add('general.home_hero_subtitle', 'TK UNITY is a premier software development studio based in Da Nang. We fuse high-performance Unity game development with advanced AI solutions to create immersive digital experiences.');
        $this->migrator->add('general.home_hero_cta_text', 'Explore Games');
        $this->migrator->add('general.home_hero_cta_url', '/games');
        $this->migrator->add('general.home_hero_cta2_text', 'AI Solutions');
        $this->migrator->add('general.home_hero_cta2_url', '/ai-trainer');
        $this->migrator->add('general.home_hero_bg', null);

        // Home - Focus Section
        $this->migrator->add('general.home_focus_label', 'Our Focus');
        $this->migrator->add('general.home_focus_title', 'Focused on <span class="accent">Impact</span>');
        $this->migrator->add('general.home_focus_desc', "We don't chase trends. We build substantial technology that serves a purpose. Our bifurcated focus allows us to specialize deeply in two critical areas of the modern digital landscape.");
        $this->migrator->add('general.home_focus_image', null);
        $this->migrator->add('general.home_focus_badge_label', 'Core Architecture');
        $this->migrator->add('general.home_focus_badge_text', 'Dual-Engine Growth');

        // Home - Sections
        $this->migrator->add('general.home_section_games_title', 'Crafting Digital <span class="accent">Worlds</span>');
        $this->migrator->add('general.home_section_games_desc', 'We build mobile games that captivate millions. Using Unity\'s powerful engine, our team creates visually stunning, performance-optimized experiences for iOS and Android.');
        $this->migrator->add('general.home_section_games_features', [
            'Cross-Platform Development',
            'High-Performance Optimization',
            'Data-Driven Game Design',
            'Live Operations & Updates'
        ]);
        $this->migrator->add('general.home_section_games_image', null);
        $this->migrator->add('general.home_section_games_badge_label', 'Engine');
        $this->migrator->add('general.home_section_games_badge_text', 'Unity');

        $this->migrator->add('general.home_section_ai_title', 'Smart Fitness <span class="accent-green">Technology</span>');
        $this->migrator->add('general.home_section_ai_desc', 'Our AI Personal Trainer uses advanced pose estimation and biomechanical analysis to provide real-time feedback that was previously only available to professional athletes.');
        $this->migrator->add('general.home_section_ai_features', [
            'Real-Time Pose Tracking',
            'Form Correction Feedback',
            'Personalized Workout Plans',
            'Progress Analytics'
        ]);
        $this->migrator->add('general.home_section_ai_image', null);
        $this->migrator->add('general.home_section_ai_badge_label', 'Technology');
        $this->migrator->add('general.home_section_ai_badge_text', 'Computer Vision');

        // Home - CTA Section
        $this->migrator->add('general.home_cta_title', 'Technical Excellence.<br>Verified Integrity.');
        $this->migrator->add('general.home_cta_desc', 'TK Unity adheres to strict industry standards. We provide transparent, high-performance software solutions for enterprise and government partners.');
        $this->migrator->add('general.home_cta_btn1_text', 'Contact Our Team');
        $this->migrator->add('general.home_cta_btn1_url', '/contact');
        $this->migrator->add('general.home_cta_btn2_text', 'About Us');
        $this->migrator->add('general.home_cta_btn2_url', '/about');
        
        // Remove old Settings if they exist (optional, but good for cleanup if migration was rigorous)
        // $this->migrator->delete('general.hero_banner');
        // $this->migrator->delete('general.about_hero');
        // $this->migrator->delete('general.process_mockup');
    }
};
