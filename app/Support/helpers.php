<?php

use App\Settings\GeneralSettings;

if (! function_exists('setting')) {
    function setting(string $key, $default = null)
    {
        $settings = app(GeneralSettings::class);

        if (str_contains($key, '.')) {
            [$group, $nested] = explode('.', $key, 2);
            if ($group === GeneralSettings::group()) {
                $key = $nested;
            }
        }

        if (property_exists($settings, $key)) {
            $value = $settings->{$key};
            return $value !== null ? $value : $default;
        }

        return $default;
    }
}

if (! function_exists('site_initials')) {
    function site_initials(): string
    {
        $name = setting('site_name', 'TKUnity');
        $compact = preg_replace('/[^A-Za-z0-9]+/', '', $name) ?: 'TK';

        return strtoupper(substr($compact, 0, 2));
    }
}

if (! function_exists('setting_url')) {
    function setting_url(string $key, ?string $fallback = null): ?string
    {
        $value = setting($key);

        if (! $value) {
            return $fallback ? asset($fallback) : null;
        }

        if (\Illuminate\Support\Str::startsWith($value, ['http://', 'https://'])) {
            return $value;
        }

        if (\Illuminate\Support\Str::startsWith($value, '/')) {
            return url($value);
        }

        if (\Illuminate\Support\Str::startsWith($value, 'images/')) {
            return asset($value);
        }

        return \Illuminate\Support\Facades\Storage::disk('public')->url($value);
    }
}
