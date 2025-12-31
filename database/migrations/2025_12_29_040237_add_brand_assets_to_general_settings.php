<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        if (! $this->migrator->exists('general.hero_banner')) {
            $this->migrator->add('general.hero_banner', 'images/home/super_hero_bg.webp');
            $this->migrator->add('general.process_mockup', 'images/tkunity_devices.webp');
        }

        if (! $this->migrator->exists('general.logo_3d')) {
            $this->migrator->add('general.logo_3d', 'images/LOGO_3D.webp');
        }

        if ($this->migrator->exists('general.logo_light')) {
            $this->migrator->update('general.logo_light', function ($payload) {
                return $payload === 'images/TKUNITY_LOGO_LIGHT.webp'
                    ? 'images/tkunity_white.webp'
                    : $payload;
            });
        } else {
            $this->migrator->add('general.logo_light', 'images/tkunity_white.webp');
        }

        if ($this->migrator->exists('general.logo_dark')) {
            $this->migrator->update('general.logo_dark', function ($payload) {
                return $payload === 'images/TKUNITY_LOGO_DARK.webp'
                    ? 'images/tkunity_dark.webp'
                    : $payload;
            });
        } else {
            $this->migrator->add('general.logo_dark', 'images/tkunity_dark.webp');
        }

        if (! $this->migrator->exists('general.logo_red')) {
            $this->migrator->add('general.logo_red', 'images/tkunity_red.webp');
        }

        if (! $this->migrator->exists('general.google_tags')) {
            $this->migrator->add('general.google_tags', null);
        }

        if (! $this->migrator->exists('general.google_verify')) {
            $this->migrator->add('general.google_verify', null);
        }

        if (! $this->migrator->exists('general.tiktok_pixel')) {
            $this->migrator->add('general.tiktok_pixel', null);
        }
    }
};
