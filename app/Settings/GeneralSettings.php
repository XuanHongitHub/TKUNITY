<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    // Identity
    public string $site_name;
    public ?string $site_description;

    // Contact & Social
    public ?string $contact_email;
    public ?string $contact_phone;
    public ?string $contact_address;
    public ?string $social_facebook;
    public ?string $social_twitter;
    public ?string $social_linkedin;
    public ?string $social_youtube;

    // Home - Hero
    public ?string $home_hero_label;
    public ?string $home_hero_title;
    public ?string $home_hero_subtitle;
    public ?string $home_hero_cta_text;
    public ?string $home_hero_cta_url;
    public ?string $home_hero_cta2_text;
    public ?string $home_hero_cta2_url;
    public ?string $home_hero_bg;

    // Home - Focus Section
    public ?string $home_focus_label;
    public ?string $home_focus_title;
    public ?string $home_focus_desc;
    public ?string $home_focus_image;
    public ?string $home_focus_badge_label;
    public ?string $home_focus_badge_text;

    // Home - Sections
    public ?string $home_section_games_title;
    public ?string $home_section_games_desc;
    public array $home_section_games_features;
    public ?string $home_section_games_image;
    public ?string $home_section_games_badge_label;
    public ?string $home_section_games_badge_text;

    public ?string $home_section_ai_title;
    public ?string $home_section_ai_desc;
    public array $home_section_ai_features;
    public ?string $home_section_ai_image;
    public ?string $home_section_ai_badge_label;
    public ?string $home_section_ai_badge_text;

    // Home - CTA Section
    public ?string $home_cta_title;
    public ?string $home_cta_desc;
    public ?string $home_cta_btn1_text;
    public ?string $home_cta_btn1_url;
    public ?string $home_cta_btn2_text;
    public ?string $home_cta_btn2_url;

    // Media
    public ?string $site_logo;
    public ?string $favicon;
    public ?string $logo_light; // Footer/Dark bg logo
    public ?string $logo_dark;  // Light bg logo
    public ?string $logo_red;   // Brand color logo
    public ?string $logo_icon;  // Mobile/Favicon alternative

    // SEO & Scripts
    public ?string $seo_title;
    public ?string $seo_description;
    public ?string $site_head;
    public ?string $site_footer;
    public ?string $google_tags;
    public ?string $google_verify;
    public ?string $tiktok_pixel;

    public static function group(): string
    {
        return 'general';
    }
}
