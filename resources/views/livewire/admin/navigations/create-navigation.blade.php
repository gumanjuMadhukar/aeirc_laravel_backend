<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('navigations.create_navigation') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('navigations.create_navigation_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="createNavigation" class="space-y-6">

        <flux:input wire:model.live="label" label="{{ __('navigations.label') }}" />
        <flux:input wire:model.live="url" label="{{ __('navigations.url') }}"
            placeholder="e.g., /about, /services, /contact-us" />

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
        {{-- Show logged in user --}}
        <flux:input label="{{ __('contacts.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('navigations.create_navigation') }}
        </flux:button>
    </x-form>
</section>