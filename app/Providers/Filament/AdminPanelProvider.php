<?php

namespace App\Providers\Filament;

use Filament\Http\Middleware\Authenticate;
use BezhanSalleh\FilamentShield\FilamentShieldPlugin;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('admin')
            ->login(\App\Filament\Pages\Auth\Login::class)
            ->sidebarCollapsibleOnDesktop()
            ->font('Space Grotesk')
            ->renderHook(
                \Filament\View\PanelsRenderHook::HEAD_END,
                fn () => \Illuminate\Support\Facades\Blade::render(<<<'HTML'
                    <style>
                        :root {
                            --fi-sidebar-width: 16rem !important;
                        }
                        /* Compact Sidebar Customization */
                        .fi-sidebar-header {
                            padding-top: 0.75rem !important;
                            padding-bottom: 0.75rem !important;
                            height: auto !important;
                        }
                        .fi-sidebar-nav {
                            gap: 0.125rem !important;
                        }
                        .fi-sidebar-item {
                            padding-block: 0.25rem !important;
                            padding-inline: 0.5rem !important;
                        }
                        .fi-sidebar-item-button {
                            padding-block: 0.375rem !important;
                            padding-inline: 0.5rem !important;
                        }
                        .fi-sidebar-item-label {
                            font-size: 0.8125rem !important;
                            font-weight: 500 !important;
                        }
                        .fi-sidebar-group-label {
                            padding-block: 0.5rem !important;
                            font-size: 0.75rem !important;
                        }
                    </style>
                    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600;700&display=swap" rel="stylesheet">
                HTML)
            )
            ->colors([
                'primary' => Color::Amber,
            ])
            ->discoverResources(in: app_path('Filament/Resources'), for: 'App\Filament\Resources')
            ->discoverPages(in: app_path('Filament/Pages'), for: 'App\Filament\Pages')
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Widgets'), for: 'App\Filament\Widgets')
            ->widgets([
                AccountWidget::class,
                FilamentInfoWidget::class,
            ])
            ->middleware([
                EncryptCookies::class,
                AddQueuedCookiesToResponse::class,
                StartSession::class,
                AuthenticateSession::class,
                ShareErrorsFromSession::class,
                VerifyCsrfToken::class,
                SubstituteBindings::class,
                DisableBladeIconComponents::class,
                DispatchServingFilamentEvent::class,
            ])
            ->plugins([
                FilamentShieldPlugin::make(),
                \ShuvroRoy\FilamentSpatieLaravelBackup\FilamentSpatieLaravelBackupPlugin::make()
                    ->noTimeout(),
                \Jeffgreco13\FilamentBreezy\BreezyCore::make()
                    ->myProfile(
                        shouldRegisterUserMenu: true,
                        shouldRegisterNavigation: false,
                        hasAvatars: false, // User resource handles avatars
                        slug: 'my-profile'
                    )
                    ->enableTwoFactorAuthentication(),
            ])
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
