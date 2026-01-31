<?php

namespace App\Filament\Employer\Resources\JobApplications;

use App\Filament\Employer\Resources\JobApplications\Pages\CreateJobApplication;
use App\Filament\Employer\Resources\JobApplications\Pages\EditJobApplication;
use App\Filament\Employer\Resources\JobApplications\Pages\ListJobApplications;
use App\Filament\Employer\Resources\JobApplications\Pages\ViewJobApplication;
use App\Filament\Employer\Resources\JobApplications\Schemas\JobApplicationForm;
use App\Filament\Employer\Resources\JobApplications\Schemas\JobApplicationInfolist;
use App\Filament\Employer\Resources\JobApplications\Tables\JobApplicationsTable;
use App\Models\JobApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Clock;

    protected static ?string $recordTitleAttribute = 'Job Application';

    public static function form(Schema $schema): Schema
    {
        return JobApplicationForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JobApplicationInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobApplicationsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListJobApplications::route('/'),
            // 'create' => CreateJobApplication::route('/create'),
            'view' => ViewJobApplication::route('/{record}'),
            // 'edit' => EditJobApplication::route('/{record}/edit'),
        ];
    }
}
