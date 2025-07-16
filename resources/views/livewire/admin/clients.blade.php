<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('clients.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('clients.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create clients')
                <flux:button href="{{ route('admin.clients.create') }}" variant="primary" icon="plus">
                    {{ __('clients.create_client') }}
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
                <x-table.heading>{{ __('clients.id') }}</x-table.heading>
                <x-table.heading>{{ __('clients.client_logo') }}</x-table.heading>
                <x-table.heading>{{ __('clients.client_name') }}</x-table.heading>
                <x-table.heading>{{ __('clients.type_of_client') }}</x-table.heading>
                <x-table.heading>{{ __('clients.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($clients as $client)
                <x-table.row wire:key="client-{{ $client->id }}">
                    <x-table.cell>{{ $client->id }}</x-table.cell>
                    <x-table.cell>
                        @if ($client->client_logo)
                        <img src="{{ asset('storage/' . $client->client_logo) }}" alt="Client Secondary Image"
                        class="mb-2 rounded" style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                        —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $client->client_name }}</x-table.cell>
                    <x-table.cell>{{ $client->type_of_client}}</x-table.cell>
                    <x-table.cell>{{ $client->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update clients')
                            <flux:button href="{{ route('admin.clients.edit', $client) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete clients')
                            <flux:modal.trigger name="delete-client-{{ $client->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-client-{{ $client->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('clients.delete_client') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('clients.you_are_about_to_delete') }}</p>
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
                                        wire:click.prevent="deleteClient('{{ $client->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteClient('{{ $client->id }}')">
                                        {{ __('clients.delete_client') }}
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
        {{ $clients->links() }}
    </div>
</section>