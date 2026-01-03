<?php

if (!function_exists('media_url')) {
    /**
     * Get media URL with fallback
     *
     * @param mixed $model Model with media
     * @param string $collection Media collection name
     * @param string|null $fallback Fallback image path
     * @return string
     */
    function media_url($model, string $collection = 'default', ?string $fallback = null): string
    {
        if (!$model) {
            return $fallback ? asset($fallback) : asset('images/placeholder.png');
        }

        $url = $model->getFirstMediaUrl($collection);
        
        if ($url) {
            return $url;
        }

        return $fallback ? asset($fallback) : asset('images/placeholder.png');
    }
}

if (!function_exists('media_img')) {
    /**
     * Generate optimized img tag with lazy loading and responsive images
     *
     * @param mixed $model Model with media
     * @param string $collection Media collection name
     * @param string|null $alt Alt text
     * @param string|null $class CSS classes
     * @param string|null $fallback Fallback image path
     * @param bool $lazy Enable lazy loading
     * @return string
     */
    function media_img(
        $model,
        string $collection = 'default',
        ?string $alt = null,
        ?string $class = null,
        ?string $fallback = null,
        bool $lazy = true
    ): string {
        $url = media_url($model, $collection, $fallback);
        $alt = htmlspecialchars($alt ?? '');
        $class = htmlspecialchars($class ?? '');

        $attrs = [
            'src' => $url,
            'alt' => $alt,
        ];

        if ($class) {
            $attrs['class'] = $class;
        }

        if ($lazy) {
            $attrs['loading'] = 'lazy';
            $attrs['decoding'] = 'async';
        }

        // Add responsive images if available
        if ($model && method_exists($model, 'hasMedia') && $model->hasMedia($collection)) {
            $media = $model->getFirstMedia($collection);
            if ($media && method_exists($media, 'hasResponsiveImages') && $media->hasResponsiveImages()) {
                $attrs['srcset'] = $media->getSrcset();
                $attrs['sizes'] = '(max-width: 768px) 100vw, 50vw';
            }
        }

        $attrString = collect($attrs)
            ->map(fn($value, $key) => sprintf('%s="%s"', $key, htmlspecialchars($value)))
            ->implode(' ');

        return "<img {$attrString}>";
    }
}
