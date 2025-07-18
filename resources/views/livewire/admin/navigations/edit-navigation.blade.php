<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('navigations.edit_navigation') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('navigations.edit_navigation_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="updateNavigation" class="space-y-6">

        <flux:input wire:model.live="label" label="{{ __('navigations.label') }}" />
        <flux:input wire:model.live="url" label="{{ __('navigations.url') }}" />

        <flux:select wire:model="type" label="{{ __('navigations.type') }}"
            placeholder="{{ __('navigations.select_type') }}">
            <flux:select.option value="navbar">Navbar</flux:select.option>
            <flux:select.option value="footer">Footer</flux:select.option>
            <flux:select.option value="both">Both</flux:select.option>
        </flux:select>

        <flux:input type="number" wire:model.live="order" label="{{ __('navigations.order') }}" />

        <flux:select wire:model="status" label="{{ __('navigations.status') }}"
            placeholder="{{ __('navigations.select_status') }}">
            <flux:select.option value="active">{{ __('navigations.status_active') }}</flux:select.option>
            <flux:select.option value="inactive">{{ __('navigations.status_inactive') }}</flux:select.option>
        </flux:select>

        {{-- Optional updated_by field for display or manual override (not recommended for normal users) --}}
        <flux:input wire:model.live="updated_by" label="{{ __('navigations.updated_by') }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('navigations.edit_navigation') }}
        </flux:button>
    </x-form>
</section>