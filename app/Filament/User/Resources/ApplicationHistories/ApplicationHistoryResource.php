<?php

namespace App\Filament\User\Resources\ApplicationHistories;

use App\Filament\User\Resources\ApplicationHistories\Pages\CreateApplicationHistory;
use App\Filament\User\Resources\ApplicationHistories\Pages\EditApplicationHistory;
use App\Filament\User\Resources\ApplicationHistories\Pages\ListApplicationHistories;
use App\Filament\User\Resources\ApplicationHistories\Pages\ViewApplicationHistory;
use App\Filament\User\Resources\ApplicationHistories\Schemas\ApplicationHistoryForm;
use App\Filament\User\Resources\ApplicationHistories\Schemas\ApplicationHistoryInfolist;
use App\Filament\User\Resources\ApplicationHistories\Tables\ApplicationHistoriesTable;
use App\Models\ApplicationHistory;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ApplicationHistoryResource extends Resource
{
    protected static ?string $model = ApplicationHistory::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::Clock;

    protected static ?string $recordTitleAttribute = 'Application History';

    public static function form(Schema $schema): Schema
    {
        return ApplicationHistoryForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ApplicationHistoryInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApplicationHistoriesTable::configure($table);
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
            'index' => ListApplicationHistories::route('/'),
            'create' => CreateApplicationHistory::route('/create'),
            'view' => ViewApplicationHistory::route('/{record}'),
            'edit' => EditApplicationHistory::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
