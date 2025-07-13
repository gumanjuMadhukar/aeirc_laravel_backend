<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('products.create_product') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('products.create_product_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="createProduct" class="space-y-6">

        <flux:input wire:model.live="product_title" label="{{ __('products.product_title') }}" />
        <flux:input wire:model.live="product_description" label="{{ __('products.product_description') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('products.updated_by') }}" />
        <flux:input wire:model.live="product_image" type="file" label="{{ __('products.product_image') }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('products.create_product') }}
        </flux:button>
    </x-form>
</section>
