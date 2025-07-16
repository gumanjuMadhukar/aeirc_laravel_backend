<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('galleryList.create_gallery') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('galleryList.create_gallery_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="createGallery" class="space-y-6">

        <flux:input wire:model.live="img_name" label="{{ __('galleryList.img_name') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('galleryList.updated_by') }}" />
        <flux:input wire:model.live="gallery_img" label="{{ __('galleryList.gallery_img') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('galleryList.create_gallery') }}
        </flux:button>
    </x-form>
</section>