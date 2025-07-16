<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('galleryList.edit_gallery') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('galleryList.edit_gallery_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateGallery" class="space-y-6">
        <flux:input wire:model.live="img_name" label="{{ __('galleryList.img_name') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('galleryList.updated_by') }}" />

        @if ($gallery_img)
            <img src="{{ asset('storage/' . $gallery_img) }}" class="h-24 mb-2 rounded" alt="Gallery Detail Image">
        @endif

        <flux:input wire:model="newGalleryImage" label="{{ __('galleryList.gallery_img') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('galleryList.edit_gallery') }}
        </flux:button>
    </x-form>
</section>
