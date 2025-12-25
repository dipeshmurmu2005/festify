<x-filament-panels::page>
    <form wire:submit="create">
        <div class="form-container">
            {{ $this->form }}
        </div>
        <x-filament::button type="submit">
            Update
        </x-filament::button>

        <style>
            .form-container {
                margin-bottom: 50px;
            }
        </style>
    </form>
</x-filament-panels::page>
