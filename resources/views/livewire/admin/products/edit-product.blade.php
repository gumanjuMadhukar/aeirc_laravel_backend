<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('products.edit_product') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('products.edit_product_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateProduct" class="space-y-6">
        <flux:input wire:model.live="product_title" label="{{ __('products.product_title') }}" />
        <flux:input wire:model.live="product_description" label="{{ __('products.product_description') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('products.updated_by') }}" />

        @if ($product_image)
            <img src="{{ asset('storage/' . $product_image) }}" class="h-24 mb-2 rounded" alt="Product Detail Image">
        @endif

        <flux:input wire:model="newProductImage" label="{{ __('products.product_image') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('products.edit_product') }}
        </flux:button>
    </x-form>
</section>
