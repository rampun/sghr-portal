<?php

namespace App\Filament\Resources\JobAds\Schemas;

use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Jobs\AdDurationEnum;
use App\Enums\Jobs\LocationEnum;
use App\Enums\Jobs\StatusEnum;
use App\Enums\Jobs\TypeEnum;
use App\Enums\Users\UserRoleEnum;
use Filament\Forms\Components\DatePicker;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class JobAdsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                Select::make('user_id')
                    ->label('Employer')
                    ->relationship(name: 'employer', titleAttribute: 'company_name', modifyQueryUsing: fn(Builder $query) => $query->WhereNotNull('company_name')->where('role', UserRoleEnum::EMPLOYER))
                    ->required(),
                Textarea::make('description')
                    ->required()
                    ->rows(5)
                    ->columnSpanFull(),
                Select::make('experience')
                    ->options(ExperienceLevelEnum::class)
                    ->required(),
                Select::make('industry')
                    ->options(IndustryEnum::class)
                    ->required(),
                Select::make('type')
                    ->options(TypeEnum::class)
                    ->required(),
                Select::make('location')
                    ->options(LocationEnum::class)
                    ->required(),
                TextInput::make('salary_min_range')
                    ->label('Salary Minimum Range (USD/month)')
                    ->numeric()
                    ->required(),
                TextInput::make('salary_max_range')
                    ->label('Salary Maximum Range (USD/month)')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->options(StatusEnum::class)
                    ->required(),
                DatePicker::make('start_date')
                    ->label('Ad Start Date')
                    ->required(),
                Select::make('duration')
                    ->label('Ad Duration')
                    ->options(AdDurationEnum::class)
                    ->required(),
            ]);
    }
}
