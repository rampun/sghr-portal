<?php

// app/Livewire/CustomProfileComponent.php

namespace App\Livewire;

use App\Enums\Users\CountryEnum;
use App\Enums\Users\EducationLevelEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Filament\Forms\Form;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;


class CustomProfileComponent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $user = Auth::user();


        // Build the form directly without using form() method
        $this->form
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

            ])->statePath('data')
            ->model(Auth::user());

        $this->form->fill([

            'phone' => $user->phone,

        ]);
    }


    public function save(): void
    {
        try {

            Auth::user()->update($this->form->getState());
            // Show success message
            $this->dispatch('notify', [
                'type' => 'success',
                'message' => 'Profile updated successfully!',
            ]);
        } catch (\Exception $e) {
            $this->dispatch('notify', [
                'type' => 'error',
                'message' => 'Failed to update profile: ' . $e->getMessage(),
            ]);
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
