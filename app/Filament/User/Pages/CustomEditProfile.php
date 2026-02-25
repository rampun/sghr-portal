<?php

// app/Filament/Pages/CustomEditProfile.php

namespace App\Filament\User\Pages;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Form;
use Filament\Schemas\Components\Section;
use Illuminate\Support\Facades\Auth;
use Joaopaulolndev\FilamentEditProfile\Pages\EditProfilePage;

class CustomEditProfile extends EditProfilePage
{
    protected static ?string $slug = 'my-profile';

    protected static ?string $navigationLabel = 'My Profile';

    protected static ?int $navigationSort = 1;

    // Override the form schema to add custom fields
    protected function getForms(): array
    {
        return [
            'updateProfile' => $this->getUpdateProfileForm(),
            'updatePassword' => $this->getUpdatePasswordForm(),
            'customFields' => $this->getCustomFieldsForm(), // Add custom fields form
        ];
    }

    // Custom fields form
    protected function getCustomFieldsForm(): Form
    {
        return $this->makeForm()
            ->schema([
                Section::make('Additional Information')
                    ->description('Update your additional profile information')
                    ->icon('heroicon-o-identification')
                    ->schema([
                        TextInput::make('user.phone')
                            ->label('Phone Number')
                            ->tel()
                            ->maxLength(20)
                            ->placeholder('+1 (555) 123-4567'),

                        DatePicker::make('user.date_of_birth')
                            ->label('Date of Birth')
                            ->maxDate(now()),

                        Select::make('user.gender')
                            ->label('Gender')
                            ->options([
                                'male' => 'Male',
                                'female' => 'Female',
                                'other' => 'Other',
                                'prefer_not_to_say' => 'Prefer not to say',
                            ])
                            ->nullable(),

                        Textarea::make('user.bio')
                            ->label('Bio')
                            ->rows(4)
                            ->maxLength(1000)
                            ->placeholder('Tell us about yourself...'),

                        Textarea::make('user.address')
                            ->label('Address')
                            ->rows(3)
                            ->maxLength(500)
                            ->placeholder('Enter your address'),

                        Toggle::make('user.newsletter_subscription')
                            ->label('Subscribe to newsletter')
                            ->default(true),

                        Toggle::make('user.email_notifications')
                            ->label('Receive email notifications')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Social Media Links')
                    ->icon('heroicon-o-share')
                    ->schema([
                        TextInput::make('user.twitter_handle')
                            ->label('Twitter/X')
                            ->prefix('@')
                            ->maxLength(50)
                            ->placeholder('username'),

                        TextInput::make('user.linkedin_url')
                            ->label('LinkedIn')
                            ->url()
                            ->maxLength(255)
                            ->placeholder('https://linkedin.com/in/username'),

                        TextInput::make('user.github_username')
                            ->label('GitHub')
                            ->prefix('@')
                            ->maxLength(50)
                            ->placeholder('username'),
                    ])
                    ->columns(2),

                Section::make('Profile Picture')
                    ->icon('heroicon-o-photo')
                    ->schema([
                        FileUpload::make('user.avatar')
                            ->label('Profile Photo')
                            ->avatar()
                            ->directory('avatars')
                            ->image()
                            ->imageEditor()
                            ->maxSize(2048)
                            ->circleCropper()
                            ->helperText('Upload a square image for best results. Max size: 2MB'),
                    ]),
            ])
            ->statePath('data')
            ->model(Auth::user())
            ->columns(1);
    }

    // Override the save method to handle custom fields
    public function saveCustomFields(): void
    {
        try {
            $user = Auth::user();
            $data = $this->form->getState();

            // Extract user data from the 'user' key
            $userData = $data['user'] ?? [];

            // Update only custom fields (avoid overwriting password, email, etc.)
            $fillableFields = [
                'phone',
                'date_of_birth',
                'gender',
                'bio',
                'address',
                'newsletter_subscription',
                'email_notifications',
                'twitter_handle',
                'linkedin_url',
                'github_username',
                'avatar',
            ];

            $updateData = array_intersect_key($userData, array_flip($fillableFields));

            // Update the user
            if (! empty($updateData)) {
                $user->update($updateData);

                // Show success notification
                $this->notify('success', 'Custom profile fields updated successfully!');
            }
        } catch (\Exception $e) {
            $this->notify('danger', 'Error updating profile: '.$e->getMessage());
        }
    }

    // Override the mount method to include custom fields
    public function mount(): void
    {
        parent::mount();

        // Fill the form with user data including custom fields
        $user = Auth::user();

        $this->form->fill([
            'user' => [
                'phone' => $user->phone,
                'date_of_birth' => $user->date_of_birth,
                'gender' => $user->gender,
                'bio' => $user->bio,
                'address' => $user->address,
                'newsletter_subscription' => $user->newsletter_subscription ?? true,
                'email_notifications' => $user->email_notifications ?? true,
                'twitter_handle' => $user->twitter_handle,
                'linkedin_url' => $user->linkedin_url,
                'github_username' => $user->github_username,
                'avatar' => $user->avatar,
            ],
        ]);
    }

    // Override the getViewData method to include custom form
    protected function getViewData(): array
    {
        return [
            'customFieldsForm' => $this->getCustomFieldsForm(),
        ];
    }
}
