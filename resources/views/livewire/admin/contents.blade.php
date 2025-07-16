<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contents.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contents.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create contents')
                <flux:button href="{{ route('admin.contents.create') }}" variant="primary" icon="plus">
                    {{ __('contents.create_content') }}
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
                <x-table.heading>{{ __('contents.id') }}</x-table.heading>
                <x-table.heading>{{ __('contents.headings') }}</x-table.heading>
                <x-table.heading>{{ __('contents.sub_headings') }}</x-table.heading>
                <x-table.heading>{{ __('contents.title') }}</x-table.heading>
                <x-table.heading>{{ __('contents.description') }}</x-table.heading>
                <x-table.heading>{{ __('contents.features') }}</x-table.heading>
                <x-table.heading>{{ __('contents.image') }}</x-table.heading>
                <x-table.heading>{{ __('contents.video') }}</x-table.heading>
                <x-table.heading>{{ __('contents.status') }}</x-table.heading>
                <x-table.heading>{{ __('contents.component') }}</x-table.heading>
                <x-table.heading>{{ __('contents.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>

        <x-slot:body>
            @foreach($contents as $content)
                <x-table.row wire:key="content-{{ $content->id }}">
                    <x-table.cell>{{ $content->id }}</x-table.cell>
                    <x-table.cell>{{ $content->headings ?? '—' }}</x-table.cell>
                    <x-table.cell>{{ $content->sub_headings ?? '—' }}</x-table.cell>
                    <x-table.cell>{{ $content->title ?? '—' }}</x-table.cell>
                    <x-table.cell>
                        {{ Str::limit($content->description, 50, '...') ?? '—' }}
                    </x-table.cell>
                    <x-table.cell>
                        @php
                            $features = $content->features ?? [];
                            $maxVisible = 1;
                        @endphp

                        @if(is_array($features) && count($features) > 0 && trim($features[0]) !== '')
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
                        @if ($content->image)
                            <img src="{{ asset('storage/' . $content->image) }}" alt="Content Image" class="rounded"
                                style="width: 120px; height: 50px; object-fit: cover;">
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($content->video)
                            <video width="100" height="70" controls>
                                <source src="{{ asset('storage/' . $content->video) }}" type="video/mp4">
                                Your browser does not support the video tag.
                            </video>
                        @else
                            —
                        @endif
                    </x-table.cell>

                    <x-table.cell>
                        <span class="{{ $content->status == 'active' ? 'text-green-600' : 'text-red-600' }}">
                            {{ ucfirst($content->status) }}
                        </span>
                    </x-table.cell>
                    <x-table.cell>{{ ucfirst($content->component ?? '—') }}</x-table.cell>
                    <x-table.cell>{{ $content->updated_by ?? '—' }}</x-table.cell>

                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update contents')
                            <flux:button href="{{ route('admin.contents.edit', $content) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan

                        @can('delete contents')
                            <flux:modal.trigger name="delete-content-{{ $content->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-content-{{ $content->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('contents.delete_content') }}?</flux:heading>
                                    <flux:subheading>
                                        <!-- <p>{{ __('contents.you_are_about_to_delete') }}
                                            <strong>{{ $content->title ?? 'this item' }}</strong>
                                        </p> -->
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">{{ __('global.cancel') }}</flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteContent('{{ $content->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteContent('{{ $content->id }}')">
                                        {{ __('contents.delete_content') }}
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
        {{ $contents->links() }}
    </div>
</section>