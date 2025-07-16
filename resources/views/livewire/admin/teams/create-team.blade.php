<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('teams.create_team') }}</x-slot:title>
        <x-slot:subtitle>{{ __('teams.create_team_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="createTeam" class="space-y-6">
        {{-- Team Name --}}
        <flux:input wire:model="name" label="{{ __('teams.name') }}" />

        {{-- Position --}}
        <flux:input wire:model="position" label="{{ __('teams.position') }}" />

        {{-- Description --}}
        <flux:input wire:model="description" label="{{ __('teams.description') }}" />

        {{-- Social media links --}}
        <flux:input wire:model="facebook" label="{{ __('teams.facebook') }}" placeholder="https://facebook.com/..." />
        <flux:input wire:model="twitter" label="{{ __('teams.twitter') }}" placeholder="https://twitter.com/..." />
        <flux:input wire:model="instagram" label="{{ __('teams.instagram') }}" placeholder="https://instagram.com/..." />
        <flux:input wire:model="linkedin" label="{{ __('teams.linkedin') }}" placeholder="https://linkedin.com/in/..." />

        {{-- Upload image --}}
        <flux:input wire:model="image" label="{{ __('teams.image') }}" type="file" />

        {{-- Show logged in user --}}
        <flux:input label="{{ __('teams.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('teams.create_team') }}
        </flux:button>
    </x-form>
</section>
