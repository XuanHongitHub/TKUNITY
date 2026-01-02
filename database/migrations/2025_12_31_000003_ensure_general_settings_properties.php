<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        // Ensure all properties in GeneralSettings exist
        if (!$this->migrator->exists('general.about_hero')) {
            $this->migrator->add('general.about_hero', 'images/pages/about.png');
        }

        if (!$this->migrator->exists('general.process_mockup')) {
            $this->migrator->add('general.process_mockup', 'images/pages/unity-tech.png');
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
