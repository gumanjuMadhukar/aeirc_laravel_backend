<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('teams.title') }}</x-slot:title>
        <x-slot:subtitle>{{ __('teams.title_description') }}</x-slot:subtitle>
        <x-slot:buttons>
            @can('create teams')
                <flux:button href="{{ route('admin.teams.create') }}" variant="primary" icon="plus">
                    {{ __('teams.create_team') }}
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
                <x-table.heading>{{ __('teams.id') }}</x-table.heading>
                <x-table.heading>{{ __('teams.image') }}</x-table.heading>
                <x-table.heading>{{ __('teams.name') }}</x-table.heading>
                <x-table.heading>{{ __('teams.position') }}</x-table.heading>
                <x-table.heading>{{ __('teams.facebook') }}</x-table.heading>
                <x-table.heading>{{ __('teams.twitter') }}</x-table.heading>
                <x-table.heading>{{ __('teams.instagram') }}</x-table.heading>
                <x-table.heading>{{ __('teams.linkedin') }}</x-table.heading>

                <x-table.heading>{{ __('teams.updated_by') }}</x-table.heading>
                <x-table.heading class="text-right">{{ __('global.actions') }}</x-table.heading>
            </x-table.row>
        </x-slot:head>

        <x-slot:body>
            @foreach($teams as $team)
                <x-table.row wire:key="team-{{ $team->id }}">
                    <x-table.cell>{{ $team->id }}</x-table.cell>
                    <x-table.cell>
                        @if ($team->image)
                            <img src="{{ asset('storage/' . $team->image) }}" alt="Team Image" class="mb-2 rounded"
                                style="width: 100px; height: 35px; object-fit: cover;">
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>{{ $team->name }}</x-table.cell>
                    <x-table.cell>{{ $team->position }}</x-table.cell>
                    <x-table.cell>{{ $team->updated_by }}</x-table.cell>
                    <x-table.cell>
                        @if ($team->facebook)
                            <a href="{{ $team->facebook }}" target="_blank" class="text-blue-600 underline">Facebook</a>
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($team->twitter)
                            <a href="{{ $team->twitter }}" target="_blank" class="text-blue-500 underline">Twitter</a>
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($team->instagram)
                            <a href="{{ $team->instagram }}" target="_blank" class="text-pink-600 underline">Instagram</a>
                        @else
                            —
                        @endif
                    </x-table.cell>
                    <x-table.cell>
                        @if ($team->linkedin)
                            <a href="{{ $team->linkedin }}" target="_blank" class="text-blue-800 underline">LinkedIn</a>
                        @else
                            —
                        @endif
                    </x-table.cell>


                    <x-table.cell class="space-x-2 flex justify-end">
                        @can('update teams')
                            <flux:button href="{{ route('admin.teams.edit', $team) }}" size="sm">
                                {{ __('global.edit') }}
                            </flux:button>
                        @endcan

                        @can('delete teams')
                            <flux:modal.trigger name="delete-team-{{ $team->id }}">
                                <flux:button size="sm" variant="danger">{{ __('global.delete') }}</flux:button>
                            </flux:modal.trigger>

                            <flux:modal name="delete-team-{{ $team->id }}"
                                class="min-w-[22rem] space-y-6 flex flex-col justify-between">
                                <div>
                                    <flux:heading size="lg">{{ __('teams.delete_team') }}?</flux:heading>
                                    <flux:subheading>
                                        <p>{{ __('teams.you_are_about_to_delete') }} <strong>{{ $team->name }}</strong></p>
                                        <p>{{ __('global.this_action_is_irreversible') }}</p>
                                    </flux:subheading>
                                </div>
                                <div class="flex gap-2 !mt-auto mb-0">
                                    <flux:modal.close>
                                        <flux:button variant="ghost">{{ __('global.cancel') }}</flux:button>
                                    </flux:modal.close>
                                    <flux:spacer />
                                    <flux:button type="submit" variant="danger"
                                        wire:click.prevent="deleteTeam('{{ $team->id }}')" wire:loading.attr="disabled"
                                        wire:target="deleteTeam('{{ $team->id }}')">
                                        {{ __('teams.delete_team') }}
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
        {{ $teams->links() }}
    </div>
</section>