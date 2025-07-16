<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('teams.edit_team') }}</x-slot:title>
        <x-slot:subtitle>{{ __('teams.edit_team_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="updateTeam" class="space-y-6">
        {{-- Team Name --}}
        <flux:input wire:model="name" label="{{ __('teams.name') }}" />

        {{-- Position --}}
        <flux:input wire:model="position" label="{{ __('teams.position') }}" />

        {{-- Description --}}
        <flux:input wire:model="description" label="{{ __('teams.description') }}" />

        {{-- Social Media Links --}}
        <flux:input wire:model="facebook" label="{{ __('teams.facebook') }}" placeholder="https://facebook.com/..." />
        <flux:input wire:model="twitter" label="{{ __('teams.twitter') }}" placeholder="https://twitter.com/..." />
        <flux:input wire:model="instagram" label="{{ __('teams.instagram') }}" placeholder="https://instagram.com/..." />
        <flux:input wire:model="linkedin" label="{{ __('teams.linkedin') }}" placeholder="https://linkedin.com/in/..." />

        {{-- Preview Existing Image --}}
        @if ($image)
            <img src="{{ asset('storage/' . $image) }}" class="h-24 mb-2 rounded" alt="Team Image" />
        @endif

        {{-- Upload New Logo --}}
        <flux:input wire:model="newImage" label="{{ __('teams.image') }}" type="file" />

        {{-- Updated By - readonly --}}
        <flux:input label="{{ __('teams.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        {{-- Hidden input for Livewire binding --}}
        <input type="hidden" wire:model="updated_by" value="{{ auth()->user()->name }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('teams.edit_team') }}
        </flux:button>
    </x-form>
</section>
