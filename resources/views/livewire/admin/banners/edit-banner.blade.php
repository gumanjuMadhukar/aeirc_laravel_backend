<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('banners.edit_banner') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('banners.edit_banner_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateBanner" class="space-y-6">

        <flux:input wire:model.live="title" label="{{ __('banners.title') }}" />
        <flux:input wire:model.live="name" label="{{ __('banners.name') }}" />
        <flux:input wire:model.live="description" label="{{ __('banners.description') }}" />
        <flux:input wire:model.live="category" label="{{ __('banners.category') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('banners.updated_by') }}" />

        <flux:select wire:model="page" label="Page" placeholder="Select a page" name="page">
            @foreach (\App\Models\Banner::PAGES as $value => $label)
                <flux:select.option value="{{ $value }}">{{ $label }}</flux:select.option>
            @endforeach
        </flux:select>


        <flux:select wire:model="status" label="{{ __('banners.status') }}"
            placeholder="{{ __('banners.select_status') }}" name="status">
            <flux:select.option value="active">{{ __('banners.status_active') }}</flux:select.option>
            <flux:select.option value="inactive">{{ __('banners.status_inactive') }}</flux:select.option>
        </flux:select>

        @if ($image)
            <img src="{{ asset('storage/' . $image) }}" class="h-24 mb-2 rounded" alt="Current Banner Image">
        @endif

        <flux:input wire:model="newImage" label="{{ __('banners.image_url') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('banners.edit_banner') }}
        </flux:button>
    </x-form>
</section>