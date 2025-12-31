<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Ensure all properties in GeneralSettings exist
        if (!$this->migrator->exists('general.about_hero')) {
            $this->migrator->add('general.about_hero', 'images/home/super_hero_bg.webp');
        }
        
        if (!$this->migrator->exists('general.process_mockup')) {
            $this->migrator->add('general.process_mockup', 'images/tkunity_devices.webp');
        }

        if (!$this->migrator->exists('general.logo_3d')) {
            $this->migrator->add('general.logo_3d', 'images/LOGO_3D.webp');
        }

        if (!$this->migrator->exists('general.logo_light')) {
            $this->migrator->add('general.logo_light', 'images/tkunity_white.webp');
        }

        if (!$this->migrator->exists('general.logo_dark')) {
            $this->migrator->add('general.logo_dark', 'images/tkunity_dark.webp');
        }

        if (!$this->migrator->exists('general.logo_red')) {
            $this->migrator->add('general.logo_red', 'images/tkunity_red.webp');
        }
    }
};
