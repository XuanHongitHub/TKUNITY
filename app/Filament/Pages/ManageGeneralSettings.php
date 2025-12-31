<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use App\Settings\GeneralSettings;
use Filament\Notifications\Notification;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class ManageGeneralSettings extends Page
{
    use WithFileUploads;

    public static function getNavigationIcon(): ?string { return 'heroicon-o-cog-6-tooth'; }
    public static function getNavigationGroup(): ?string { return 'Appearance'; }
    public function getTitle(): string { return 'General Settings'; }
    
    protected string $view = 'filament.pages.manage-general-settings';

    // Properties
    public $site_name;
    public $site_description;
    public $theme_color;
    public $site_logo; // File upload
    public $favicon;   // File upload
    public $seo_title;
    public $seo_description;
    public $site_head;
    public $site_footer;
    public $hero_banner;
    public $logo_3d;
    public $logo_light;
    public $logo_dark;
    public $logo_red;
    public $google_tags;
    public $google_verify;
    public $tiktok_pixel;
    
    // Existing values for display if needed (e.g. image preview)
    public $existing_site_logo;
    public $existing_favicon;
    public $existing_hero_banner;
    public $existing_logo_3d;
    public $existing_logo_light;
    public $existing_logo_dark;
    public $existing_logo_red;

    public function mount(GeneralSettings $settings): void
    {
        $this->site_name = $settings->site_name;
        $this->site_description = $settings->site_description;
        $this->theme_color = $settings->theme_color;
        $this->seo_title = $settings->seo_title;
        $this->seo_description = $settings->seo_description;
        $this->existing_site_logo = $settings->site_logo;
        $this->existing_favicon = $settings->favicon;
        $this->site_head = $settings->site_head;
        $this->site_footer = $settings->site_footer;
        $this->google_tags = $settings->google_tags;
        $this->google_verify = $settings->google_verify;
        $this->tiktok_pixel = $settings->tiktok_pixel;
        $this->existing_hero_banner = $settings->hero_banner;
        $this->existing_logo_3d = $settings->logo_3d;
        $this->existing_logo_light = $settings->logo_light;
        $this->existing_logo_dark = $settings->logo_dark;
        $this->existing_logo_red = $settings->logo_red;
    }

    public function save(GeneralSettings $settings): void
    {
        $this->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string',
            'theme_color' => 'required|string',
            'site_logo' => 'nullable|image|max:1024',
            'favicon' => 'nullable|image|max:512',
            'seo_title' => 'nullable|string|max:60',
            'seo_description' => 'nullable|string|max:160',
            'site_head' => 'nullable|string',
            'site_footer' => 'nullable|string',
            'google_tags' => 'nullable|string',
            'google_verify' => 'nullable|string|max:255',
            'tiktok_pixel' => 'nullable|string',
            'hero_banner' => 'nullable|image|max:4096',
            'logo_3d' => 'nullable|image|max:4096',
            'logo_light' => 'nullable|image|max:2048',
            'logo_dark' => 'nullable|image|max:2048',
            'logo_red' => 'nullable|image|max:2048',
        ]);

        $settings->site_name = $this->site_name;
        $settings->site_description = $this->site_description;
        $settings->theme_color = $this->theme_color;
        $settings->seo_title = $this->seo_title;
        $settings->seo_description = $this->seo_description;
        $settings->site_head = $this->site_head;
        $settings->site_footer = $this->site_footer;
        $settings->google_tags = $this->google_tags;
        $settings->google_verify = $this->google_verify;
        $settings->tiktok_pixel = $this->tiktok_pixel;

        if ($this->site_logo) {
            $settings->site_logo = $this->site_logo->store('settings', 'public');
        }
        if ($this->favicon) {
            $settings->favicon = $this->favicon->store('settings', 'public');
        }
        if ($this->hero_banner) {
            $settings->hero_banner = $this->hero_banner->store('settings', 'public');
        }
        if ($this->logo_3d) {
            $settings->logo_3d = $this->logo_3d->store('settings', 'public');
        }
        if ($this->logo_light) {
            $settings->logo_light = $this->logo_light->store('settings', 'public');
        }
        if ($this->logo_dark) {
            $settings->logo_dark = $this->logo_dark->store('settings', 'public');
        }
        if ($this->logo_red) {
            $settings->logo_red = $this->logo_red->store('settings', 'public');
        }

        $settings->save();

        // Update existing previews
        if ($this->site_logo) $this->existing_site_logo = $settings->site_logo;
        if ($this->favicon) $this->existing_favicon = $settings->favicon;
        if ($this->hero_banner) $this->existing_hero_banner = $settings->hero_banner;
        if ($this->logo_3d) $this->existing_logo_3d = $settings->logo_3d;
        if ($this->logo_light) $this->existing_logo_light = $settings->logo_light;
        if ($this->logo_dark) $this->existing_logo_dark = $settings->logo_dark;
        if ($this->logo_red) $this->existing_logo_red = $settings->logo_red;
        
        // Reset file inputs
        $this->site_logo = null;
        $this->favicon = null;
        $this->hero_banner = null;
        $this->logo_3d = null;
        $this->logo_light = null;
        $this->logo_dark = null;
        $this->logo_red = null;

        Notification::make() 
            ->success()
            ->title('Settings saved successfully')
            ->send();
    }
}
