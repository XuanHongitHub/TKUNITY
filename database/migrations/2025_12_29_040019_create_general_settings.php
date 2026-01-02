<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'TK Unity');
        $this->migrator->add('general.site_description', 'Official TK Unity platform for mobile games, AI training, and publishing.');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.seo_title', 'TK Unity');
        $this->migrator->add('general.seo_description', 'Official TK Unity platform updates, products, and company information.');
        $this->migrator->add('general.social_links', []);
        $this->migrator->add('general.hero_banner', 'images/home/hero.png');
        $this->migrator->add('general.logo_light', 'images/tkunity_white.webp');
        $this->migrator->add('general.logo_dark', 'images/tkunity_dark.webp');
        $this->migrator->add('general.logo_red', 'images/tkunity_red.webp');
        $this->migrator->add('general.google_tags', null);
        $this->migrator->add('general.google_verify', null);
        $this->migrator->add('general.tiktok_pixel', null);
    }
};
