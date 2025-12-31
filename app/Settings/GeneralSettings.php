<?php

namespace App\Settings;

use Spatie\LaravelSettings\Settings;

class GeneralSettings extends Settings
{
    public string $site_name;
    public ?string $site_description;
    public string $theme_color;
    public ?string $site_logo;
    public ?string $favicon;
    public ?string $seo_title;
    public ?string $seo_description;
    public array $social_links;
    public ?string $site_head = null;
    public ?string $site_footer = null;
    public ?string $hero_banner = null;
    public ?string $about_hero = null;
    public ?string $process_mockup = null;
    public ?string $logo_3d = null;
    public ?string $logo_light = null;
    public ?string $logo_dark = null;
    public ?string $logo_red = null;
    public ?string $google_tags = null;
    public ?string $google_verify = null;
    public ?string $tiktok_pixel = null;

    public static function group(): string
    {
        return 'general';
    }
}
