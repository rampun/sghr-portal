<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\UserRoleEnum;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->components([
                        TextEntry::make('id')
                            ->label('ID')
                            ->columnSpanFull(),
                        TextEntry::make('name'),
                        TextEntry::make('email'),
                        TextEntry::make('phone'),
                        TextEntry::make('role'),
                        TextEntry::make('status'),
                    ])->columnSpan('full')
                    ->columns(2),

                // Conditional Job Seeker fields
                Section::make('Job Seeker Information')
                    ->components([
                        TextEntry::make('education_level'),
                        TextEntry::make('experience_level'),
                        TextEntry::make('industry'),
                        TextEntry::make('skills'),
                        TextEntry::make('current_company'),
                        TextEntry::make('current_position'),
                        TextEntry::make('total_exeperience_years')->label('Years of Experience'),
                        TextEntry::make('expected_salary')->label('Expected Salary (USD)'),
                        TextEntry::make('country'),
                        TextEntry::make('resume_url')->label('Resume URL'),
                    ])->columnSpan('full')
                    ->columns(2)
                    ->visible(fn(Get $get): bool => $get('role') === UserRoleEnum::JOB_SEEKER),

                // Conditional Employer fields
                Section::make('Employer Information')
                    ->components([
                        TextEntry::make('company_name'),
                        TextEntry::make('company_size'),
                        TextEntry::make('company_website'),
                        TextEntry::make('company_description'),
                        TextEntry::make('company_industry'),
                        TextEntry::make('company_country'),
                    ])->columnSpan('full')
                    ->columns(2)
                    ->visible(fn(Get $get): bool => $get('role') === UserRoleEnum::EMPLOYER)
            ]);
    }
}
