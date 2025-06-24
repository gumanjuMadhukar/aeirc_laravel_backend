<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('banners.create_banner') }}</x-slot:title>
        <x-slot:subtitle>
            {{ __('banners.create_banner_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="createBanner" class="space-y-6">

        <flux:input wire:model.live="title" label="{{ __('banners.title') }}" />
        <flux:input wire:model.live="name" label="{{ __('banners.name') }}" />
        <flux:input wire:model.live="description" label="{{ __('banners.description') }}" />
        <flux:input wire:model.live="category" label="{{ __('banners.category') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('banners.updated_by') }}" />
        
        <flux:select wire:model="status" label="{{ __('banners.status') }}" placeholder="{{ __('banners.select_status') }}" name="status">
            <flux:select.option value="active">{{ __('banners.status_active') }}</flux:select.option>
            <flux:select.option value="inactive">{{ __('banners.status_inactive') }}</flux:select.option>
        </flux:select>

        {{-- Optional: image URL or file upload --}}
        <flux:input wire:model.live="image" label="{{ __('banners.image_url') }}" type="file" />

        {{-- Optional: use checkbox or toggle for visibility --}}
        {{-- 
        <flux:checkbox label="{{ __('banners.visible') }}" wire:model.live="visible" />
        --}}

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('banners.create_banner') }}
        </flux:button>
    </x-form>
</section>
