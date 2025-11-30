<?php

namespace App\Filament\Helper;

use Filament\Auth\Pages\Login;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use Illuminate\Contracts\Support\Htmlable;
use SensitiveParameter;

class AdminLoginForm extends Login
{
    public function getHeading(): string|Htmlable|null
    {
        return 'Admin Login';
    }

    public function getSubheading(): string|Htmlable|null
    {
        return null;
        return 'Login to HR Admin';
    }


    public function form(Schema $schema): Schema
    {
        return $schema->components([

            $this->getEmailFormComponent(),
            $this->getPasswordFormComponent(),
            // Select::make('role')
            //     ->options([
            //         '1' => 'Candidate',
            //         '2' => 'Employer',
            //     ])
            //     ->native(false),
            $this->getRememberFormComponent(),
        ]);
    }

    /**
     * @param  array<string, mixed>  $data
     * @return array<string, mixed>
     */
    protected function getCredentialsFromFormData(#[SensitiveParameter] array $data): array
    {
        return [
            'email' => $data['email'],
            'password' => $data['password'],
            // 'role' => $data['role'],
        ];
    }
}
