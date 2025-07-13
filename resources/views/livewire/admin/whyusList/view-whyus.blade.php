<section class="w-full">
    <x-page-heading>
        <x-slot:title>View Whyus</x-slot:title>
        <x-slot:subtitle>Viewing whyus: {{ $whyus->item_title }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <!-- <div>
            <strong>Component Title:</strong> {{ $whyus->whyus_component_title }}
        </div>

        <div>
            <strong>Title:</strong> {{ $whyus->whyus_title }}
        </div>

        <div>
            <strong>Description:</strong> {{ $whyus->whyus_description }}
        </div> -->

        <div>
            <strong>Item Title:</strong> {{ $whyus->item_title }}
        </div>

        <div>
            <strong>Item Icon:</strong> <i class="{{ $whyus->item_icon }}"></i> ({{ $whyus->item_icon }})
        </div>

        <div>
            <strong>Item Description:</strong> {{ $whyus->item_description }}
        </div>

        <div>
            <strong>Updated By:</strong> {{ $whyus->updated_by }}
        </div>

        <!-- <div>
            <strong>Image:</strong><br>
            @if($whyus->image)
                <img src="{{ asset('storage/' . $whyus->image) }}" alt="{{ $whyus->whyus_title }}" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">No image available</span>
            @endif
        </div> -->
    </div>
</section>
