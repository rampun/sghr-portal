<?php

namespace App\Filament\Employer\Resources\JobAds;

use App\Filament\Employer\Resources\JobAds\Pages\CreateJobAds;
use App\Filament\Employer\Resources\JobAds\Pages\EditJobAds;
use App\Filament\Employer\Resources\JobAds\Pages\ListJobAds;
use App\Filament\Employer\Resources\JobAds\Pages\ViewJobAds;
use App\Filament\Employer\Resources\JobAds\Schemas\JobAdsForm;
use App\Filament\Employer\Resources\JobAds\Schemas\JobAdsInfolist;
use App\Filament\Employer\Resources\JobAds\Tables\JobAdsTable;
use App\Models\JobAds;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class JobAdsResource extends Resource
{
    protected static ?string $model = JobAds::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedBriefcase;

    protected static ?string $recordTitleAttribute = 'Job Ads';

    protected static ?string $navigationLabel = 'My Job Ads';

    public static function form(Schema $schema): Schema
    {
        return JobAdsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return JobAdsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JobAdsTable::configure($table);
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
            'index' => ListJobAds::route('/'),
            'create' => CreateJobAds::route('/create'),
            'view' => ViewJobAds::route('/{record}'),
            'edit' => EditJobAds::route('/{record}/edit'),
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
