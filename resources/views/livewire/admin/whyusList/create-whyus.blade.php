<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('whyusList.create_whyus') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('whyusList.create_whyus_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="createWhyus" class="space-y-6">

        <!-- <flux:input wire:model.live="whyus_component_title" label="{{ __('whyusList.whyus_component_title') }}" />
        <flux:input wire:model.live="whyus_title" label="{{ __('whyusList.whyus_title') }}" />
        <flux:input wire:model.live="whyus_description" label="{{ __('whyusList.whyus_description') }}" /> -->
        
        <flux:input wire:model.live="item_title" label="{{ __('whyusList.item_title') }}" />
        <flux:input wire:model.live="item_icon" label="{{ __('whyusList.item_icon') }}"  placeholder="e.g. fa-solid fa-robot" />
        <flux:input wire:model.live="item_description" label="{{ __('whyusList.item_description') }}" />

        <flux:input wire:model.live="updated_by" label="{{ __('whyusList.updated_by') }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('whyusList.create_whyus') }}
        </flux:button>
    </x-form>
</section>
