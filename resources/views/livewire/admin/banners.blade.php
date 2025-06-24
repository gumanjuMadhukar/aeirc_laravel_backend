<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('banners.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('banners.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create banners')
                <flux:button href="{{ route('admin.banners.create') }}" variant="primary" icon="plus">
                    {{ __('banners.create_banner') }}
                </flux:button>
            @endcan
        </x-slot:buttons>
    </x-page-heading>

    <div class="flex items-center justify-between w-full mb-6 gap-2">
        <flux:input wire:model.live="search" placeholder="{{ __('global.search_here') }}" class="!w-auto"/>
        <flux:spacer/>

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
                <x-table.heading>{{ __('global.id') }}</x-table.heading>
                <x-table.heading>{{ __('banners.title') }}</x-table.heading>
                <x-table.heading>{{ __('banners.name') }}</x-table.heading>
                <x-table.heading>{{ __('banners.description') }}</x-table.heading>
                <x-table.heading>{{ __('banners.category') }}</x-table.heading>
                <x-table.heading>{{ __('banners.updated_by') }}</x-table.heading>
                <x-table.heading>{{ __('banners.status') }}</x-table.heading>
                <x-table.heading>{{ __('banners.image') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($banners as $banner)
                <x-table.row wire:key="user-{{ $banner->id }}">
                    <x-table.cell>{{ $banner->id }}</x-table.cell>
                    <x-table.cell>{{ $banner->title }}</x-table.cell>
                    <x-table.cell>{{ $banner->name }}</x-table.cell>
                    <x-table.cell>{{ $banner->description }}</x-table.cell>
                    <x-table.cell>{{ $banner->category }}</x-table.cell>
                    <x-table.cell>{{ $banner->updated_by}}</x-table.cell>
                    <x-table.cell>{{ $banner->status }}</x-table.cell> 
                    <x-table.cell><img src="{{ asset('storage/' . $banner->image ) }}" class="mb-2 rounded" alt="Current Banner Image" style="width:100%; height:35px; object-fit: cover;"></x-table.cell> 
                    <x-table.cell class="space-x-2 flex justify-end">

                        @can('update banners')
                            <flux:button href="{{ route('admin.banners.edit', $banner) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete banners')
                            <flux:modal.trigger name="delete-profile-{{ $banner->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>
                            <flux:modal name="delete-profile-{{ $banner->id }}"
                                        class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('banners.delete_banner') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('banners.you_are_about_to_delete') }}</p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">
                                            {{ __('global.cancel') }}
                                        </flux:button>
                                    </flux:modal.close>
                                    <flux:spacer/>
                                    <flux:button type="submit" variant="danger"
                                                 wire:click.prevent="deletePermission('{{ $banner->id }}')">
                                        {{ __('banners.delete_banner') }}
                                    </flux:button>
                                </div>
                            </flux:modal>
                        @endcan
                    </x-table.cell>
                </x-table.row>
            @endforeach
        </x-slot:body>
    </x-table>

    <div>
        {{ $banners->links() }}
    </div>

</section>
