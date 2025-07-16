<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contacts.create_contact') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contacts.create_contact_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="createContact" class="space-y-6">
        <flux:input wire:model="address" label="{{ __('contacts.address') }}" />
        <flux:input wire:model="mobile" label="{{ __('contacts.mobile') }}" />
        <flux:input wire:model="email" label="{{ __('contacts.email') }}" />
<flux:input 
    wire:model="map_iframe" 
    label="Google Map Embed" 
    type="textarea" 
    placeholder='<iframe src="https://www.google.com/maps/embed?pb=..." width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>' 
/>

        <p class="text-sm text-gray-500 mt-1">
            Please paste the full iframe embed code from Google Maps here.
        </p>

        {{-- Show logged in user --}}
        <flux:input label="{{ __('contacts.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('contacts.create_contact') }}
        </flux:button>
    </x-form>
</section>