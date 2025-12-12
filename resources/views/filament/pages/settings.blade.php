<x-filament-panels::page>
    <form wire:submit="save">
        {{ $this->form }}

        <x-filament::actions class="mt-4"
            :actions="$this->getFormActions()"
        />
    </form>
</x-filament-panels::page>