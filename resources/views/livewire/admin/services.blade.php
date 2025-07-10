<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('services.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('services.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create services')
                <flux:button href="{{ route('admin.services.create') }}" variant="primary" icon="plus">
                    {{ __('services.create_service') }}
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
                <x-table.heading>{{ __('services.id') }}</x-table.heading>
                <x-table.heading>{{ __('services.description') }}</x-table.heading>
                <x-table.heading>{{ __('services.description_for_list') }}</x-table.heading>
                <x-table.heading>{{ __('services.list') }}</x-table.heading>
                <x-table.heading>{{ __('services.image') }}</x-table.heading>
                <x-table.heading>{{ __('services.component_title') }}</x-table.heading>
                <x-table.heading>{{ __('services.service_icon') }}</x-table.heading>
                <x-table.heading>{{ __('services.service_name') }}</x-table.heading>
                <x-table.heading>{{ __('services.service_description') }}</x-table.heading>
                <x-table.heading>{{ __('services.service_features') }}</x-table.heading>
                <x-table.heading>{{ __('services.service_image') }}</x-table.heading>
                <x-table.heading>{{ __('services.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>
        <x-slot:body>
            @foreach($services as $service)
                <x-table.row wire:key="service-{{ $service->id }}">
                    <x-table.cell>{{ $service->id }}</x-table.cell>
                    <x-table.cell>{{ $service->description }}</x-table.cell>
                    <x-table.cell>{{ $service->description_for_list }}</x-table.cell>
                    <x-table.cell>{{ $service->list }}</x-table.cell>
                    <x-table.cell>
                        @if ($service->image)
                            <img src="{{ asset('storage/' . $service->image) }}" alt="Service Image" class="mb-2 rounded"
                                style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $service->component_title }}</x-table.cell>
                    <x-table.cell>{{ $service->service_icon }}</x-table.cell>
                    <x-table.cell>{{ $service->service_name }}</x-table.cell>
                    <x-table.cell>{{ $service->service_description }}</x-table.cell>
                    <x-table.cell>
                        @php
                            $features = explode(',', $service->service_features ?? '');
                            $maxVisible = 1;
                        @endphp

                        @if(count($features) > 0 && trim($features[0]) !== '')
                            <ul class="list-disc list-inside text-sm max-w-xs break-words">
                                @foreach(array_slice($features, 0, $maxVisible) as $feature)
                                    <li>{{ trim($feature) }}</li>
                                @endforeach
                                @if(count($features) > $maxVisible)
                                    <li>…</li>
                                @endif
                            </ul>
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($service->service_image)
                            <img src="{{ asset('storage/' . $service->service_image) }}" alt="Service Secondary Image"
                                class="mb-2 rounded" style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $service->updated_by }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update services')
                            <flux:button href="{{ route('admin.services.edit', $service) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan
                        @can('delete services')
                            <flux:modal.trigger name="delete-service-{{ $service->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-service-{{ $service->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('services.delete_service') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('services.you_are_about_to_delete') }}</p>
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
                                        wire:click.prevent="deleteService('{{ $service->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteService('{{ $service->id }}')">
                                        {{ __('services.delete_service') }}
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
        {{ $services->links() }}
    </div>
</section>