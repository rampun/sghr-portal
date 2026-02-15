<?php

namespace App\Filament\User\Resources\SavedJobs;

use App\Filament\User\Resources\SavedJobs\Pages\CreateSavedJobs;
use App\Filament\User\Resources\SavedJobs\Pages\EditSavedJobs;
use App\Filament\User\Resources\SavedJobs\Pages\ListSavedJobs;
use App\Filament\User\Resources\SavedJobs\Pages\ViewSavedJobs;
use App\Filament\User\Resources\SavedJobs\Schemas\SavedJobsForm;
use App\Filament\User\Resources\SavedJobs\Schemas\SavedJobsInfolist;
use App\Filament\User\Resources\SavedJobs\Tables\SavedJobsTable;
use App\Models\SavedJobs;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SavedJobsResource extends Resource
{
    protected static ?string $model = SavedJobs::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBookmark;

    protected static ?string $recordTitleAttribute = 'Saved';

    public static function form(Schema $schema): Schema
    {
        return SavedJobsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SavedJobsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SavedJobsTable::configure($table);
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
            'index' => ListSavedJobs::route('/'),
            'create' => CreateSavedJobs::route('/create'),
            'view' => ViewSavedJobs::route('/{record}'),
            'edit' => EditSavedJobs::route('/{record}/edit'),
        ];
    }
}
