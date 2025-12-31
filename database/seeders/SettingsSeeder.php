<?php

namespace Database\Seeders;

use App\Settings\GeneralSettings;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = app(GeneralSettings::class);

        if (! $settings->site_name) {
            $settings->site_name = 'TKUnity';
        }

        if (! $settings->site_description) {
            $settings->site_description = 'Your gateway to immersive gaming. Discover new worlds and compete with players worldwide.';
        }

        if (! $settings->theme_color || strtolower($settings->theme_color) === '#f59e0b') {
            $settings->theme_color = '#dc2626';
        }

        if (! $settings->hero_banner) {
            $settings->hero_banner = 'images/home/super_hero_bg.png';
            $settings->about_hero = 'images/home/super_hero_bg.png';
            $settings->process_mockup = 'images/tkunity_devices.png';
        }

        if (! $settings->logo_3d) {
            $settings->logo_3d = 'images/LOGO_3D.webp';
        }

        if (! $settings->logo_light || $settings->logo_light === 'images/TKUNITY_LOGO_LIGHT.webp') {
            $settings->logo_light = 'images/tkunity_white.webp';
        }

        if (! $settings->logo_dark || $settings->logo_dark === 'images/TKUNITY_LOGO_DARK.webp') {
            $settings->logo_dark = 'images/tkunity_dark.webp';
        }

        if (! $settings->logo_red) {
            $settings->logo_red = 'images/tkunity_red.webp';
        }

        $settings->save();
    }
}
