<section class="w-full">
    <x-page-heading>
        <x-slot:title>View Banner</x-slot:title>
        <x-slot:subtitle>Viewing banner: {{ $banner->title }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>Title:</strong> {{ $banner->title }}
        </div>

        <div>
            <strong>Status:</strong> {{ ucfirst($banner->status) }}
        </div>

        <div>
            <strong>Image:</strong><br>
            @if($banner->image)
                <img src="{{ asset('storage/' . $banner->image) }}" alt="{{ $banner->title }}" class="w-64 mt-2 rounded shadow" />
                <!-- <img src="{{ $banner->image }}" alt="{{ $banner->title }}" class="w-64 mt-2 rounded shadow" /> -->
            @else
                <span class="text-gray-500 italic">No image available</span>
            @endif
        </div>
    </div>
</section>
