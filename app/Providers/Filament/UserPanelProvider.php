<?php

namespace App\Providers\Filament;

use App\Filament\Helper\JobSeekerLoginForm;
use App\Filament\Helper\JobSeekerRegisterForm;
use App\Filament\Pages\Dashboard;
use Filament\Http\Middleware\Authenticate;
use Filament\Http\Middleware\AuthenticateSession;
use Filament\Http\Middleware\DisableBladeIconComponents;
use Filament\Http\Middleware\DispatchServingFilamentEvent;
use Filament\Navigation\NavigationItem;
use Filament\Panel;
use Filament\PanelProvider;
use Filament\Support\Colors\Color;
use Filament\Support\Enums\Width;
use Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse;
use Illuminate\Cookie\Middleware\EncryptCookies;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;
use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class UserPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->id('jobseeker')
            ->path('jobseeker')
            ->colors([
                'primary' => Color::Blue,
            ])
            ->registration(JobSeekerRegisterForm::class)
            ->login(JobSeekerLoginForm::class)
            ->discoverResources(in: app_path('Filament/User/Resources'), for: 'App\Filament\User\Resources')
            ->discoverPages(in: app_path('Filament/User/Pages'), for: 'App\Filament\User\Pages')
            ->maxContentWidth(Width::Full)
            ->pages([
                Dashboard::class,
            ])
            ->discoverWidgets(in: app_path('Filament/User/Widgets'), for: 'App\Filament\User\Widgets')
            ->spa()
            ->sidebarCollapsibleOnDesktop()
            ->navigation()
            ->passwordReset()
            ->emailVerification()
            ->emailVerificationRoutePrefix('email-verification') // Add this line
            ->widgets([
                // AccountWidget::class,
                // FilamentInfoWidget::class,
            ])
            ->navigationItems([
                NavigationItem::make('Explore Jobs')
                    ->url(url('/jobs'), shouldOpenInNewTab: true)
                    ->icon('heroicon-o-briefcase')
                    ->sort(6),
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
