<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('products.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('products.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create products')
                <flux:button href="{{ route('admin.products.create') }}" variant="primary" icon="plus">
                    {{ __('products.create_product') }}
                </flux:button>
            @endcan
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
        <flux:input wire:model.live="search" placeholder="{{ __('global.search_here') }}" class="!w-auto" />
        <flux:spacer />
        <flux:select wire:model.live="perPage" class="!w-auto">
            <flux:select.option value="10">{{ __('global.10_per_page') }}</flux:select.option>
            <flux:select.option value="25">{{ __('global.25_per_page') }}</flux:select.option>
            <flux:select.option value="50">{{ __('global.50_per_page') }}</flux:select.option>
            <flux:select.option value="100">{{ __('global.100_per_page') }}</flux:select.option>
        </flux:select>
    </div>

    <x-table>
        <x-slot:head>
            <x-table.row>
                <x-table.heading>{{ __('products.id') }}</x-table.heading>
                <x-table.heading>{{ __('products.product_title') }}</x-table.heading>
                <x-table.heading>{{ __('products.product_description') }}</x-table.heading>
                <x-table.heading>{{ __('products.product_image') }}</x-table.heading>
                <x-table.heading>{{ __('products.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($products as $product)
                <x-table.row wire:key="product-{{ $product->id }}">
                    <x-table.cell>{{ $product->id }}</x-table.cell>
                    <x-table.cell>{{ $product->product_title }}</x-table.cell>
                    <x-table.cell>{{ $product->product_description }}</x-table.cell>
                    <x-table.cell>
                        @if ($product->product_image)
                            <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Secondary Image"
                                class="mb-2 rounded" style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $product->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update products')
                            <flux:button href="{{ route('admin.products.edit', $product) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete products')
                            <flux:modal.trigger name="delete-product-{{ $product->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-product-{{ $product->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('products.delete_product') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('products.you_are_about_to_delete') }}</p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">
                                            {{ __('global.cancel') }}
                                        </flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteProduct('{{ $product->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteProduct('{{ $product->id }}')">
                                        {{ __('products.delete_product') }}
                                    </flux:button>
                                </div>
                            </flux:modal>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</section>