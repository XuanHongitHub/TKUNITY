<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->add('general.site_name', 'Bepack');
        $this->migrator->add('general.site_description', 'Premium Laravel Starter Kit');
        $this->migrator->add('general.theme_color', '#F59E0B');
        $this->migrator->add('general.site_logo', null);
        $this->migrator->add('general.favicon', null);
        $this->migrator->add('general.seo_title', 'Bepack - Admin Panel');
        $this->migrator->add('general.seo_description', 'Manage your application with ease.');
        $this->migrator->add('general.social_links', []);
    }
};
