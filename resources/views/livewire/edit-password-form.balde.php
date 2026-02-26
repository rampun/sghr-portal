<div>
    @if (session()->has('message'))
    <div class="alert alert-success">
        {{ session('message') }}
    </div>
    @endif

    <form wire:submit="update">
        {{ $this->form }}

        <button type="submit" class="btn btn-primary">
            Update Password
        </button>
    </form>

    <x-filament-actions::modals />
</div>