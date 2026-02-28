<?php

namespace App\Filament\Resources\JobApplications\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class JobApplicationInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Application Information')
                    ->components([
                        TextEntry::make('job.title')->label('Position applied for')
                            ->placeholder('-'),
                        TextEntry::make('created_at')->label('Applied Date')
                            ->placeholder('-'),
                    ])->columnSpan('full')
                    ->columns(2),

                // Conditional Job Seeker fields
                Section::make('Applicant Information')
                    ->components([
                        TextEntry::make('jobseeker.name')
                            ->label('Full Name')
                            ->placeholder('-'),
                        TextEntry::make('jobseeker.education_level'),
                        TextEntry::make('jobseeker.experience_level'),
                        TextEntry::make('jobseeker.user_industry')->label('Industry'),
                        TextEntry::make('jobseeker.user_skills')->label('Skills'),
                        TextEntry::make('jobseeker.current_company'),
                        TextEntry::make('jobseeker.current_position'),
                        TextEntry::make('jobseeker.total_exeperience_years')->label('Years of Experience'),
                        TextEntry::make('jobseeker.user_country')->label('Country'),
                    ])->columnSpan('full')
                    ->columns(2),
            ]);
    }
}
