<?php

namespace App\Livewire;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Concerns\InteractsWithSchemas;
use Filament\Schemas\Contracts\HasSchemas;
use Filament\Schemas\Schema;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class EditPasswordForm extends Component implements HasSchemas // 👈 Must implement this
{
    use InteractsWithSchemas; // 👈 Must use this trait

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Schema $schema): Schema // 👈 Note: Schema not Form in v4
    {
        return $schema
            ->components([
                TextInput::make('current_password')
                    ->password()
                    ->required(),
                TextInput::make('new_password')
                    ->password()
                    ->required()
                    ->minLength(8),
                TextInput::make('new_password_confirmation')
                    ->password()
                    ->required()
                    ->same('new_password'),
            ])
            ->statePath('data');
    }

    public function update(): void
    {
        $data = $this->form->getState();
        // Handle password update
    }

    public function render(): View
    {
        return view('livewire.edit-password-form');
    }
}
