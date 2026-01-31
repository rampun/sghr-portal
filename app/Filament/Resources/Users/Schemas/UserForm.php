<?php

namespace App\Filament\Resources\Users\Schemas;

use App\Enums\Users\CompanySizeEnum;
use App\Enums\Users\CountryEnum;
use App\Enums\Users\EducationLevelEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('General Information')
                    ->components([
                        TextInput::make('first_name')
                            ->autocapitalize('words')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('last_name')
                            ->autocapitalize('words')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->placeholder('example@example.com')
                            ->required()
                            ->email()
                            ->unique()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Phone Number (including country code)')
                            ->placeholder('+1234567890')
                            ->tel()
                            ->required()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        Select::make('role')
                            ->options(UserRoleEnum::class)
                            ->live()
                            ->required(),
                        Select::make('status')
                            ->options(UserStatusEnum::class)
                            ->required(),
                    ])->columnSpan('full')
                    ->columns(2),

                // Conditional Job Seeker fields
                Section::make('Job Seeker Information')
                    ->components([
                        Select::make('education_level')
                            ->label('Education Level')
                            ->options(EducationLevelEnum::class)
                            ->required(),
                        TagsInput::make('user_skills')
                            ->label('Skills')
                            ->required(),
                        Select::make('user_industry')
                            ->label('Industry')
                            ->options(IndustryEnum::class)
                            ->required(),
                        Select::make('user_country')
                            ->label('Country')
                            ->options(CountryEnum::class)
                            ->required(),
                        TextInput::make('current_company')
                            ->label('Current Company')
                            ->required()
                            ->autocapitalize('words')
                            ->maxLength(255),
                        TextInput::make('current_position')
                            ->label('Current Position')
                            ->required()
                            ->autocapitalize('words')
                            ->maxLength(255),
                        Select::make('experience_level')
                            ->label('Experience Level')
                            ->options(ExperienceLevelEnum::class)
                            ->required(),
                        TextInput::make('total_exeperience_years')
                            ->label('Total Experience (Years)')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                        TextInput::make('expected_salary')
                            ->label('Expected Salary (USD per month)')
                            ->numeric()
                            ->minValue(0)
                            ->required(),
                        FileUpload::make('resume_url')
                            ->label('Resume')
                            ->acceptedFileTypes(['application/pdf'])
                            ->maxSize(2048) // 2MB
                            ->disk('cloudinary')
                            ->maxFiles(1)
                            ->directory('sghr_assets/resumes')
                            ->required(),

                    ])->columnSpan('full')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => $get('role') === UserRoleEnum::JOB_SEEKER),

                // Conditional employer fields
                Section::make('Employer Information')
                    ->components([
                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('company_website')
                            ->label('Website')
                            ->placeholder('https://www.example.com')
                            ->url()
                            ->maxLength(255),
                        Textarea::make('company_description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->required(),
                        Select::make('company_size')
                            ->label('Company Size')
                            ->options(CompanySizeEnum::class)
                            ->required(),
                        Select::make('company_industry')
                            ->label('Industry')
                            ->options(IndustryEnum::class)
                            ->required(),
                        FileUpload::make('logo_url')
                            ->label('Company Logo')
                            ->image(['png', 'jpg', 'jpeg'])
                            ->maxSize(2048) // 2MB
                            ->disk('cloudinary')
                            ->maxFiles(1)
                            ->directory('sghr_assets/logos')
                            ->required(),
                        Select::make('company_country')
                            ->label('Country')
                            ->options(CountryEnum::class)
                            ->required(),
                    ])->columnSpan('full')
                    ->columns(2)
                    ->visible(fn (Get $get): bool => $get('role') === UserRoleEnum::EMPLOYER),
            ]);
    }
}
