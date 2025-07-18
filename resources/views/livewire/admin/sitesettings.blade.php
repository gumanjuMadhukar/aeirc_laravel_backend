<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('sitesettings.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('sitesettings.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create sitesettings')
                <flux:button href="{{ route('admin.sitesettings.create') }}" variant="primary" icon="plus">
                    {{ __('sitesettings.create_sitesetting') }}
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
                <x-table.heading>{{ __('sitesettings.site_title') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.favicon') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.nav_title') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.nav_icon') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.footer_title') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.footer_icon') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.facebook_url') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.linkedin_url') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.twitter_url') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.instagram_url') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.youtube_url') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.status') }}</x-table.heading>
                <x-table.heading>{{ __('sitesettings.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>

        <x-slot:body>
            @foreach($sitesettings as $setting)
                <x-table.row wire:key="setting-{{ $setting->id }}">
                    <x-table.cell>{{ $setting->id }}</x-table.cell>
                    <x-table.cell>{{ $setting->site_title }}</x-table.cell>
                    <x-table.cell>
                        @if ($setting->favicon)
                            <img src="{{ asset('storage/' . $setting->favicon) }}" alt="favicon" class="mb-2 rounded"
                            alt="Current favicon Image" style="width:100%; height:35px; object-fit: cover;" />
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $setting->nav_title }}</x-table.cell>
                    <x-table.cell>
                        @if ($setting->nav_icon)
                            <img src="{{ asset('storage/' . $setting->nav_icon) }}" alt="nav_icon" class="mb-2 rounded"
                            alt="Current nav_icon Image" style="width:100%; height:35px; object-fit: cover;" />
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($setting->footer_icon)
                            <img src="{{ asset('storage/' . $setting->footer_icon) }}" alt="footer_icon" class="mb-2 rounded"
                            alt="Current footer_icon Image" style="width:100%; height:35px; object-fit: cover;" />
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $setting->footer_title }}</x-table.cell>
                    <x-table.cell>{{ $setting->facebook_url }}</x-table.cell>
                    <x-table.cell>{{ $setting->linkedin_url }}</x-table.cell>
                    <x-table.cell>{{ $setting->twitter_url }}</x-table.cell>
                    <x-table.cell>{{ $setting->instagram_url }}</x-table.cell>
                    <x-table.cell>{{ $setting->youtube_url }}</x-table.cell>
                    <x-table.cell>{{ $setting->status }}</x-table.cell>

                    <x-table.cell>{{ $setting->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update sitesettings')
                            <flux:button href="{{ route('admin.sitesettings.edit', $setting) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan

                        @can('delete sitesettings')
                            <flux:modal.trigger name="delete-sitesetting-{{ $setting->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-sitesetting-{{ $setting->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('sitesettings.delete_sitesetting') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('sitesettings.you_are_about_to_delete') }}
                                            <strong>{{ $setting->site_title }}</strong>.
                                        </p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">{{ __('global.cancel') }}</flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteSitesetting('{{ $setting->id }}')"
                                        wire:loading.attr="disabled" wire:target="deleteSitesetting('{{ $setting->id }}')">
                                        {{ __('sitesettings.delete_sitesetting') }}
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
        {{ $sitesettings->links() }}
    </div>
</section>