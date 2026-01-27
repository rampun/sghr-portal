<?php

namespace App\Filament\Helper;

use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use App\Models\User;
use Filament\Auth\Pages\Register as BaseRegister;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Component;
use Filament\Schemas\Schema;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\Support\Htmlable;
use Illuminate\Support\Facades\Hash;

class JobSeekerRegisterForm extends BaseRegister
{
    public function getHeading(): string|Htmlable|null
    {
        return 'Job Seeker Registration';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return null;

        return 'Register to Job Seeker Portal';
    }

    public function form(Schema $schema): Schema
    {
        return $schema->components([
            $this->getFirstNameFormComponent(),
            $this->getLastNameFormComponent(),
            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            $this->getPasswordConfirmationFormComponent(),
        ])->statePath('data');
    }

    protected function handleRegistration(array $data): \Illuminate\Foundation\Auth\User
    {
        try {
            // Create user
            $user = User::create([
                'first_name' => $data['first_name'],
                'last_name' => $data['last_name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'email_verified_at' => null, // Ensure email is not verified initially
                'role' => UserRoleEnum::JOB_SEEKER,
                'status' => UserStatusEnum::ACTIVE,
            ]);

            // Fire registered event
            event(new Registered($user));

            // Show success notification IN THE CURRENT PANEL
            Notification::make()
                ->id('register-success') // Unique ID
                ->title('Registration Successful!')
                ->body('Your account has been created successfully.')
                ->success()
                ->persistent() // Stays until dismissed
                ->send();

            // Show verification notification
            Notification::make()
                ->id('verification-sent')
                ->title('Verification Email Sent')
                ->body('Please check your email to verify your account.')
                ->info()
                ->persistent() // Stays until dismissed
                ->send();

            // Redirect to login page (optional)
            $this->redirect(route('filament.jobseeker.auth.login'));

            return $user;
        } catch (\Exception $e) {
            // Show error notification
            Notification::make()
                ->id('register-error')
                ->title('Registration Failed')
                ->body($e->getMessage())
                ->danger()
                ->persistent()
                ->send();

            throw $e;
        }
    }

    protected function getEmailFormComponent(): Component
    {
        return TextInput::make('email')
            ->label('Email Address')
            ->email()
            ->required()
            ->maxLength(255)
            ->unique(User::class)
            ->autocomplete('email');
    }

    protected function getPasswordFormComponent(): Component
    {
        return TextInput::make('password')
            ->label('Password')
            ->password()
            ->required()
            ->rules('min:8')
            ->autocomplete('new-password');
    }

    protected function getPasswordConfirmationFormComponent(): Component
    {
        return TextInput::make('password_confirmation')
            ->label('Confirm Password')
            ->password()
            ->required()
            ->same('password')
            ->dehydrated(false);
    }

    protected function getFirstNameFormComponent(): Component
    {
        return TextInput::make('first_name')
            ->label('First Name')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function getLastNameFormComponent(): Component
    {
        return TextInput::make('last_name')
            ->label('Last Name')
            ->required()
            ->maxLength(255)
            ->autofocus();
    }

    protected function afterRegister(): void {}
}
