<?php

namespace App\Filament\User\Resources\JobApplications;

use App\Filament\User\Resources\JobApplications\Pages\CreateJobApplication;
use App\Filament\User\Resources\JobApplications\Pages\EditJobApplication;
use App\Filament\User\Resources\JobApplications\Pages\ListJobApplications;
use App\Filament\User\Resources\JobApplications\Schemas\JobApplicationForm;
use App\Filament\User\Resources\JobApplications\Tables\JobApplicationsTable;
use App\Models\JobApplication;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class JobApplicationResource extends Resource
{
    protected static ?string $model = JobApplication::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedClock;

    protected static ?string $recordTitleAttribute = 'Application History';

    public static function form(Schema $schema): Schema
    {
        return JobApplicationForm::configure($schema);
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
            // 'edit' => EditJobApplication::route('/{record}/edit'),
        ];
    }
}
