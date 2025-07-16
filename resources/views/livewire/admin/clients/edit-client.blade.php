<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('clients.edit_client') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('clients.edit_client_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateClient" class="space-y-6">
        {{-- Client Name --}}
        <flux:input wire:model="client_name" label="{{ __('clients.client_name') }}" />

        {{-- Updated By - Read-only --}}
        <flux:input label="{{ __('clients.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        {{-- Type of Client --}}
        <flux:input wire:model="type_of_client" label="{{ __('clients.type_of_client') }}" />

        {{-- Preview Existing Logo --}}
        @if ($client_logo)
            <img src="{{ asset('storage/' . $client_logo) }}" class="h-24 mb-2 rounded" alt="Client Detail Image">
        @endif

        {{-- Upload New Logo --}}
        <flux:input wire:model="newClientImage" label="{{ __('clients.client_logo') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('clients.edit_client') }}
        </flux:button>
    </x-form>
</section>