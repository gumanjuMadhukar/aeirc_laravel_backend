<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contacts.edit_contact') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contacts.edit_contact_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="updateContact" class="space-y-6">
        <flux:input wire:model="address" label="{{ __('contacts.address') }}" />
        <flux:input wire:model="mobile" label="{{ __('contacts.mobile') }}" />
        <flux:input wire:model="email" label="{{ __('contacts.email') }}" />
        <flux:input wire:model="map_iframe" label="{{ __('contacts.map_iframe') }}" />

        {{-- Updated By - readonly --}}
        <flux:input label="{{ __('contacts.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        {{-- Hidden input for Livewire binding --}}
        <input type="hidden" wire:model="updated_by" value="{{ auth()->user()->name }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('contacts.edit_contact') }}
        </flux:button>
    </x-form>
</section>
