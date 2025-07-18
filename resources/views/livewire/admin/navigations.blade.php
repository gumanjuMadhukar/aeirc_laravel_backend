<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('navigations.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('navigations.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create navigations')
                <flux:button href="{{ route('admin.navigations.create') }}" variant="primary" icon="plus">
                    {{ __('navigations.create_navigation') }}
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
                <x-table.heading>{{ __('global.id') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.label') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.url') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.type') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.order') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.updated_by') }}</x-table.heading>
                <x-table.heading>{{ __('navigations.status') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>

        <x-slot:body>
            @foreach($navigations as $nav)
                <x-table.row wire:key="nav-{{ $nav->id }}">
                    <x-table.cell>{{ $nav->id }}</x-table.cell>
                    <x-table.cell>{{ $nav->label }}</x-table.cell>
                    <x-table.cell>{{ $nav->url }}</x-table.cell>
                    <x-table.cell>{{ ucfirst($nav->type) }}</x-table.cell>
                    <x-table.cell>{{ $nav->order }}</x-table.cell>
                    <x-table.cell>{{ $nav->updated_by }}</x-table.cell>
                    <x-table.cell>
                        @if ($nav->status === 'active')
                            <span class="text-green-600">{{ __('navigations.status_active') }}</span>
                        @else
                            <span class="text-red-500">{{ __('navigations.status_inactive') }}</span>
                        @endif
                    </x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update navigations')
                            <flux:button href="{{ route('admin.navigations.edit', $nav) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan

                        @can('delete navigations')
                            <flux:modal.trigger name="delete-navigation-{{ $nav->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-navigation-{{ $nav->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('navigations.delete_navigation') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('navigations.you_are_about_to_delete') }} <strong>{{ $nav->label }}</strong>.</p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">{{ __('global.cancel') }}</flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteNavigation('{{ $nav->id }}')"
                                        wire:loading.attr="disabled"
                                        wire:target="deleteNavigation('{{ $nav->id }}')">
                                        {{ __('navigations.delete_navigation') }}
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
        {{ $navigations->links() }}
    </div>
</section>
