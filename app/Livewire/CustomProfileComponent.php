<?php

// app/Livewire/CustomProfileComponent.php

namespace App\Livewire;

use App\Enums\Users\CompanySizeEnum;
use App\Enums\Users\CountryEnum;
use App\Enums\Users\EducationLevelEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Users\UserRoleEnum;
use App\Models\User;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification; // 👈 v4 trait
use Filament\Schemas\Components\Section; // 👈 v4 interface
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class CustomProfileComponent extends Component implements HasSchemas
{
    use InteractsWithSchemas; // 👈 v4 trait

    public ?array $data = [];

    public function mount(): void
    {
        // prefill form with existing user data
        $this->form->fill(auth()->user()->toArray());
    }

    public function form(Schema $schema): Schema // 👈 v4 uses Schema type-hint
    {
        return $schema
            ->components([
                Section::make('Additional Profile Information')
                    ->aside()
                    ->description('Please provide additional information to complete your profile.')
                    ->schema([
                        TextInput::make('phone')
                            ->label('Phone Number (including country code)')
                            ->placeholder('+1234567890')
                            ->tel()
                            ->required()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
                        Select::make('education_level')
                            ->label('Education Level')
                            ->options(EducationLevelEnum::class),
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
                            ->autocapitalize('words')
                            ->maxLength(255),
                        TextInput::make('current_position')
                            ->label('Current Position')
                            ->autocapitalize('words')
                            ->maxLength(255),
                        Select::make('experience_level')
                            ->label('Experience Level')
                            ->options(ExperienceLevelEnum::class)
                            ->required(),
                        TextInput::make('total_exeperience_years')
                            ->label('Total Experience (Years)')
                            ->numeric()
                            ->minValue(0),
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
                    ->visible(auth()->user()->role === UserRoleEnum::JOB_SEEKER),

                Section::make('Employer Information')
                    ->aside()
                    ->description('Please provide additional information to complete your profile.')
                    ->schema([
                        TextInput::make('company_name')
                            ->required()
                            ->maxLength(255),
                        Textarea::make('company_description')
                            ->label('Description')
                            ->rows(3)
                            ->maxLength(1000)
                            ->required(),
                        TextInput::make('company_website')
                            ->label('Website')
                            ->placeholder('https://www.example.com')
                            ->url()
                            ->maxLength(255),
                        TextInput::make('phone')
                            ->label('Phone Number (including country code)')
                            ->placeholder('+1234567890')
                            ->tel()
                            ->required()
                            ->telRegex('/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\/0-9]*$/'),
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
                    ->visible(auth()->user()->role === UserRoleEnum::EMPLOYER),
            ])
            ->statePath('data')
            ->model(auth()->user()); // 👈 Pass the model instance
    }

    public function save(): void
    {
        $formData = $this->form->getState();

        try {
            // Get validated form data
            $formData = $this->form->getState();
            // Update the authenticated user's profile with the form data
            User::where('id', auth()->id())->update($formData);
            Notification::make()
                ->title('Profile updated successfully')
                ->success()
                ->send();

            // Refill the form with the updated data to reflect changes
            $this->form->fill($formData);
        } catch (\Exception $e) {
            Notification::make()
                ->title('Failed to update profile'.$e->getMessage())
                ->body('An error occurred while updating your profile. Please try again.')
                ->danger()
                ->send();
        }
    }

    public function render(): View
    {
        return view('livewire.custom-profile-component');
    }

    public static function getSort(): int
    {
        return 20; // Adjust the sort order as needed
    }
}
