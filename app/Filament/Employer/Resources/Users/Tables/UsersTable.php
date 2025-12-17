<?php

namespace App\Filament\Employer\Resources\Users\Tables;

use App\Enums\Users\CountryEnum;
use App\Enums\Users\ExperienceLevelEnum;
use App\Enums\Users\IndustryEnum;
use App\Enums\Users\UserRoleEnum;
use App\Enums\Users\UserStatusEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('first_name')
                    ->searchable(),
                TextColumn::make('last_name')
                    ->searchable(),
                TextColumn::make('user_industry')
                    ->label('Industry')
                    ->searchable(),
                TextColumn::make('user_skills')
                    ->label('Skills')
                    ->searchable()
                    ->badge(),
                TextColumn::make('experience_level')
                    ->label('Experience')
                    ->searchable(),
                TextColumn::make('user_country')
                    ->label('Country')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('user_country')
                    ->label('Country')
                    ->options(CountryEnum::class),
                SelectFilter::make('user_industry')
                    ->label('Industry')
                    ->options(IndustryEnum::class),
                SelectFilter::make('experience_level')
                    ->label('Experience')
                    ->options(ExperienceLevelEnum::class),
            ])
            ->modifyQueryUsing(function (Builder $query): Builder {
                return $query->where('role', UserRoleEnum::JOB_SEEKER->value)
                    ->where('status', UserStatusEnum::ACTIVE->value);
            })
            ->recordActions([
                ViewAction::make(),
                // EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
