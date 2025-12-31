<?php

namespace App\Filament\Pages\Auth;

use Filament\Auth\Pages\Login as BaseLogin;
use Filament\View\PanelsRenderHook;
use Illuminate\Contracts\Support\Htmlable;

class Login extends BaseLogin
{
    protected string $view = 'filament.pages.auth.login';

    public function getHeading(): string | Htmlable
    {
        return 'Welcome Back';
    }

    public function getSubheading(): string | Htmlable | null
    {
        return 'Sign in to access the TKUnity Dashboard';
    }
}
