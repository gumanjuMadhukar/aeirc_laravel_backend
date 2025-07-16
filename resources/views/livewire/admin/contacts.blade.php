<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contacts.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contacts.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create contacts')
                <flux:button href="{{ route('admin.contacts.create') }}" variant="primary" icon="plus">
                    {{ __('contacts.create_contact') }}
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
                <x-table.heading>{{ __('contacts.id') }}</x-table.heading>
                <x-table.heading>{{ __('contacts.address') }}</x-table.heading>
                <x-table.heading>{{ __('contacts.mobile') }}</x-table.heading>
                <x-table.heading>{{ __('contacts.email') }}</x-table.heading>
                <x-table.heading>{{ __('contacts.map_iframe') }}</x-table.heading>
                <x-table.heading>{{ __('contacts.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>

        <x-slot:body>
            @foreach($contacts as $contact)
                <x-table.row wire:key="contact-{{ $contact->id }}">
                    <x-table.cell>{{ $contact->id }}</x-table.cell>
                    <x-table.cell>{{ $contact->address }}</x-table.cell>
                    <x-table.cell>{{ $contact->mobile }}</x-table.cell>
                    <x-table.cell>{{ $contact->email }}</x-table.cell>
                    <x-table.cell>{{ $contact->map_iframe }}</x-table.cell>
                    <x-table.cell>{{ $contact->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update contacts')
                            <flux:button href="{{ route('admin.contacts.edit', $contact) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan

                        @can('delete contacts')
                            <flux:modal.trigger name="delete-contact-{{ $contact->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-contact-{{ $contact->id }}" class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('contacts.delete_contact') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('contacts.you_are_about_to_delete') }}</p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">{{ __('global.cancel') }}</flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteContact('{{ $contact->id }}')"
                                        wire:loading.attr="disabled"
                                        wire:target="deleteContact('{{ $contact->id }}')">
                                        {{ __('contacts.delete_contact') }}
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
        {{ $contacts->links() }}
    </div>
</section>
