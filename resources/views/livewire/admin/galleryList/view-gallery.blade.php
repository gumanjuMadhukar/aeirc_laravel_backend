<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('galleryList.view_gallery') }}</x-slot:title>
        <x-slot:subtitle>{{ __('galleryList.viewing_gallery', ['title' => $gallery->gallery_title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('galleryList.img_name') }}:</strong> {{ $gallery->img_name }}
        </div>
<!-- 
        <div>
            <strong>{{ __('galleryList.gallery_description') }}:</strong> {{ $gallery->gallery_description }}
        </div> -->

        <div>
            <strong>{{ __('galleryList.updated_by') }}:</strong> {{ $gallery->updated_by }}
        </div>

        <div>
            <strong>{{ __('galleryList.gallery_image') }}:</strong><br>
            @if($gallery->gallery_image)
                <img src="{{ asset('storage/' . $gallery->gallery_image) }}" alt="{{ __('galleryList.gallery_detail_image') }}" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('galleryList.no_detail_image_available') }}</span>
            @endif
        </div>
    </div>
</section>
