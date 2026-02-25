<?php

namespace App\Providers;

use App\Livewire\CustomProfileComponent as EditProfileForm;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Livewire::component('edit_profile_form', EditProfileForm::class);
    }
}
