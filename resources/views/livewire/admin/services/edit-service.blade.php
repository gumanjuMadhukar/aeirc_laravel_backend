<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('services.edit_service') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('services.edit_service_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateService" class="space-y-6">
        <flux:input wire:model.live="component_title" label="{{ __('services.component_title') }}" />
        <flux:input wire:model.live="description" label="{{ __('services.description') }}" />
        <flux:input wire:model.live="description_for_list" label="{{ __('services.description_for_list') }}" />
        <flux:input wire:model.live="list" label="{{ __('services.list') }}" />
        <flux:input wire:model.live="service_icon" label="{{ __('services.service_icon') }}" />
        <flux:input wire:model.live="service_name" label="{{ __('services.service_name') }}" />
        <flux:input wire:model.live="service_description" label="{{ __('services.service_description') }}" />

        <!-- Service Features as Dynamic List -->
        <div>
            <label class="block text-sm mb-2">{{ __('services.service_features') }}</label>

            <div class="space-y-3">
                @foreach ($service_features as $index => $feature)
                    <div class="flex items-center gap-3">
                        <input
                            wire:model.live="service_features.{{ $index }}"
                            type="text"
                            placeholder="{{ __('services.enter_feature') }}"
                            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 placeholder-gray-400
                                   focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 sm:text-sm"
                        />
                        @if(count($service_features) > 1)
                            <button
                                type="button"
                                wire:click="removeFeature({{ $index }})"
                                class="text-red-600 hover:text-red-800 transition-colors duration-200 rounded px-2 py-1 text-sm"
                                aria-label="Remove feature"
                            >
                                ✖
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

            <button
                type="button"
                wire:click="addFeature"
                class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-semibold focus:outline-none focus:underline"
            >
                + {{ __('services.add_more_features') }}
            </button>
        </div>

        <flux:input wire:model.live="updated_by" label="{{ __('services.updated_by') }}" />

        @if ($image)
            <img src="{{ asset('storage/' . $image) }}" class="h-24 mb-2 rounded" alt="Current Service Image">
        @endif

        <flux:input wire:model="newImage" label="{{ __('services.image') }}" type="file" />

        @if ($service_image)
            <img src="{{ asset('storage/' . $service_image) }}" class="h-24 mb-2 rounded" alt="Service Detail Image">
        @endif

        <flux:input wire:model="newServiceImage" label="{{ __('services.service_image') }}" type="file" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('services.update_service') }}
        </flux:button>
    </x-form>
</section>
