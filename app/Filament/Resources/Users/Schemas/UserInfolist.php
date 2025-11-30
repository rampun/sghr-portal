<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class UserInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('id')
                    ->label('ID')
                    ->columnSpanFull(),
                TextEntry::make('name'),
                TextEntry::make('email'),
                TextEntry::make('phone'),
                TextEntry::make('deleted_at')
                    ->date()
                    ->visible(fn($record): bool => $record->trashed()),
            ]);
    }
}
