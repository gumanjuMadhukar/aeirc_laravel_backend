<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('galleryList.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('galleryList.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create galleryList')
                <flux:button href="{{ route('admin.galleryList.create') }}" variant="primary" icon="plus">
                    {{ __('galleryList.create_gallery') }}
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
                <x-table.heading>{{ __('galleryList.id') }}</x-table.heading>
                <x-table.heading>{{ __('galleryList.gallery_img') }}</x-table.heading>
                <x-table.heading>{{ __('galleryList.img_name') }}</x-table.heading>
                <x-table.heading>{{ __('galleryList.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($galleryList as $gallery)
                <x-table.row wire:key="gallery-{{ $gallery->id }}">
                    <x-table.cell>{{ $gallery->id }}</x-table.cell>
                    <x-table.cell>
                        @if ($gallery->gallery_img)
                        <img src="{{ asset('storage/' . $gallery->gallery_img) }}" alt="Gallery Secondary Image"
                        class="mb-2 rounded" style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                        —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $gallery->img_name }}</x-table.cell>
                    <x-table.cell>{{ $gallery->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update galleryList')
                            <flux:button href="{{ route('admin.galleryList.edit', $gallery) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete galleryList')
                            <flux:modal.trigger name="delete-gallery-{{ $gallery->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-gallery-{{ $gallery->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('galleryList.delete_gallery') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('galleryList.you_are_about_to_delete') }}</p>
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
                                        wire:click.prevent="deleteGallery('{{ $gallery->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteGallery('{{ $gallery->id }}')">
                                        {{ __('galleryList.delete_gallery') }}
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
        {{ $galleryList->links() }}
    </div>
</section>