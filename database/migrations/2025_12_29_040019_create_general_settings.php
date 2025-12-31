<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'TKUnity');
        $this->migrator->add('general.site_description', 'Your gateway to immersive gaming. Discover new worlds and compete with players worldwide.');
        $this->migrator->add('general.theme_color', '#dc2626');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.seo_title', 'TKUnity - Admin Panel');
        $this->migrator->add('general.seo_description', 'Manage your application with ease.');
        $this->migrator->add('general.social_links', []);
        $this->migrator->add('general.hero_banner', 'images/home/super_hero_bg.webp');
        $this->migrator->add('general.logo_3d', 'images/LOGO_3D.webp');
        $this->migrator->add('general.logo_light', 'images/tkunity_white.webp');
        $this->migrator->add('general.logo_dark', 'images/tkunity_dark.webp');
        $this->migrator->add('general.logo_red', 'images/tkunity_red.webp');
        $this->migrator->add('general.google_tags', null);
        $this->migrator->add('general.google_verify', null);
        $this->migrator->add('general.tiktok_pixel', null);
    }
};
