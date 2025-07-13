<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('products.view_product') }}</x-slot:title>
        <x-slot:subtitle>{{ __('products.viewing_product', ['title' => $product->product_title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('products.product_title') }}:</strong> {{ $product->product_title }}
        </div>

        <div>
            <strong>{{ __('products.product_description') }}:</strong> {{ $product->product_description }}
        </div>

        <div>
            <strong>{{ __('products.updated_by') }}:</strong> {{ $product->updated_by }}
        </div>

        <div>
            <strong>{{ __('products.product_image') }}:</strong><br>
            @if($product->product_image)
                <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ __('products.product_detail_image') }}" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('products.no_detail_image_available') }}</span>
            @endif
        </div>
    </div>
</section>
