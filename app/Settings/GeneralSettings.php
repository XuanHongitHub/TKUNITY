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

    public static function group(): string
    {
        return 'general';
    }
}