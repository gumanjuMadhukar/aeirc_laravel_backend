<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('clients.create_client') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('clients.create_client_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="createClient" class="space-y-6">

        <flux:input wire:model="client_name" label="{{ __('clients.client_name') }}" />

        {{-- Updated By - Read-only --}}
        <flux:input label="{{ __('clients.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        <flux:select wire:model="type_of_client" label="Type of Client" placeholder="Select type">
            @foreach (\App\Models\Client::PAGES as $value => $label)
                <flux:select.option value="{{ $value }}">{{ $label }}</flux:select.option>
            @endforeach
        </flux:select>

        <flux:input wire:model="client_logo" label="{{ __('clients.client_logo') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('clients.create_client') }}
        </flux:button>

    </x-form>

</section>