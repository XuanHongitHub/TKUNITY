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

if (! function_exists('unique_slug')) {
    function unique_slug(string $modelClass, string $value, ?int $ignoreId = null, string $column = 'slug', string $fallback = 'item'): string
    {
        $slug = \Illuminate\Support\Str::slug($value);

        if ($slug === '') {
            $slug = $fallback;
        }

        $baseQuery = $modelClass::query();
        if ($ignoreId) {
            $baseQuery->whereKeyNot($ignoreId);
        }

        $base = $slug;
        $suffix = 2;

        while ((clone $baseQuery)->where($column, $slug)->exists()) {
            $slug = $base . '-' . $suffix;
            $suffix++;
        }

        return $slug;
    }
}

if (! function_exists('media_url')) {
    /**
     * Get media URL from a model with Spatie Media Library
     *
     * @param mixed $model Model with HasMedia trait
     * @param string $collection Media collection name
     * @param string|null $fallback Fallback image path
     * @return string|null
     */
    function media_url($model, string $collection = 'default', ?string $fallback = null): ?string
    {
        if (! $model) {
            return $fallback ? asset($fallback) : null;
        }

        $media = $model->getFirstMedia($collection);

        if ($media) {
            return $media->getUrl();
        }

        return $fallback ? asset($fallback) : null;
    }
}
