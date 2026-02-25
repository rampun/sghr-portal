<?php

namespace App\Providers\Filament;

use App\Filament\Helper\EmployerLoginForm;
use App\Filament\Helper\EmployerRegisterForm;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Pages\Dashboard;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Filament\View\PanelsRenderHook;
use Filament\Widgets\AccountWidget;
use Filament\Widgets\FilamentInfoWidget;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class EmployerPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('employer')
            ->path('employer')
            ->colors([
                'primary' => Color::Amber,
            ])
            ->globalSearch(false)
            ->registration(EmployerRegisterForm::class)
            ->login(EmployerLoginForm::class)
            ->discoverResources(in: app_path('Filament/Employer/Resources'), for: 'App\Filament\Employer\Resources')
            ->discoverPages(in: app_path('Filament/Employer/Pages'), for: 'App\Filament\Employer\Pages')
            ->pages([
                // Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/Employer/Widgets'), for: 'App\Filament\Employer\Widgets')
            ->spa()
            ->navigation()
            ->passwordReset()
            ->emailVerification()
            ->emailVerificationRoutePrefix('email-verification') // Add this line
            ->emailChangeVerification()
            ->sidebarCollapsibleOnDesktop()
            ->maxContentWidth(Width::Full)
            ->darkMode(false) // Disables dark mode
            ->renderHook(
                PanelsRenderHook::AUTH_LOGIN_FORM_AFTER,
                fn () => view('partials.auth.register-link'),
            )
            ->renderHook(
                PanelsRenderHook::AUTH_REGISTER_FORM_AFTER,
                fn () => view('partials.auth.login-link'),
            )
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
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
            ->authMiddleware([
                Authenticate::class,
            ]);
    }
}
