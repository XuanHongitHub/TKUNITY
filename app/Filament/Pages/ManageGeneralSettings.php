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
    
    // Existing values for display if needed (e.g. image preview)
    public $existing_site_logo;
    public $existing_favicon;

    public function mount(GeneralSettings $settings): void
    {
        $this->site_name = $settings->site_name;
        $this->site_description = $settings->site_description;
        $this->theme_color = $settings->theme_color;
        $this->seo_title = $settings->seo_title;
        $this->seo_description = $settings->seo_description;
        $this->existing_site_logo = $settings->site_logo;
        $this->existing_favicon = $settings->favicon;
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
        ]);

        $settings->site_name = $this->site_name;
        $settings->site_description = $this->site_description;
        $settings->theme_color = $this->theme_color;
        $settings->seo_title = $this->seo_title;
        $settings->seo_description = $this->seo_description;

        if ($this->site_logo) {
            $settings->site_logo = $this->site_logo->store('settings', 'public');
        }
        if ($this->favicon) {
            $settings->favicon = $this->favicon->store('settings', 'public');
        }

        $settings->save();

        // Update existing previews
        if ($this->site_logo) $this->existing_site_logo = $settings->site_logo;
        if ($this->favicon) $this->existing_favicon = $settings->favicon;
        
        // Reset file inputs
        $this->site_logo = null;
        $this->favicon = null;

        Notification::make() 
            ->success()
            ->title('Settings saved successfully')
            ->send();
    }
}
