<?php

namespace App\Filament\Employer\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('name'),
                TextEntry::make('education_level'),
                TextEntry::make('experience_level'),
                TextEntry::make('user_industry'),
                TextEntry::make('user_skills'),
                TextEntry::make('current_company'),
                TextEntry::make('current_position'),
                TextEntry::make('total_exeperience_years')->label('Years of Experience'),
                TextEntry::make('expected_salary')->label('Expected Salary (USD)'),
                TextEntry::make('user_country'),
            ]);
    }
}
