<?php

use Spatie\LaravelSettings\Migrations\SettingsMigration;

return new class extends SettingsMigration
{
    public function up(): void
    {
        $this->migrator->update('general.theme_color', function ($payload) {
            $value = is_string($payload) ? strtolower($payload) : $payload;

            return $value === '#f59e0b' ? '#dc2626' : $payload;
        });
    }
};
