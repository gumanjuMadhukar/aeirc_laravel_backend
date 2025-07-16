<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contents.create_content') }}</x-slot:title>
        <x-slot:subtitle>{{ __('content.create_contents_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="createContent" class="space-y-6">
        <flux:input wire:model.live="headings" label="{{ __('contents.headings') }}" placeholder="Main Heading" />
        <flux:input wire:model.live="sub_headings" label="{{ __('contents.sub_headings') }}" placeholder="Sub Heading (optional)" />
        <flux:input wire:model.live="title" label="{{ __('contents.title') }}" placeholder="Title" />
        <flux:input wire:model.live="description" label="{{ __('contents.description') }}" type="textarea" placeholder="Description or content details" />

        <!-- Features List Input -->
        <div>
            <label class="block text-sm mb-1">{{ __('contents.features') }}</label>

            <div class="space-y-3">
                @foreach ($features as $index => $feature)
                    <div class="flex items-center gap-3">
                        <input
                            wire:model.live="features.{{ $index }}"
                            type="text"
                            placeholder="{{ __('content.enter_feature') }}"
                            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 placeholder-gray-400
                                   focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 sm:text-sm"
                        />
                        @if(count($features) > 1)
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
                + {{ __('contents.add_more_features') }}
            </button>
        </div>

        <flux:input wire:model.live="image" type="file" label="{{ __('contents.image') }}" placeholder="Image URL or upload logic here" />
        <flux:input wire:model.live="video" type="file" label="{{ __('contents.video') }}" placeholder="Video URL (e.g. YouTube embed link)" />

        <flux:select wire:model.live="status" label="{{ __('contents.status') }}">
            <flux:select.option value="active">Active</flux:select.option>
            <flux:select.option value="inactive">Inactive</flux:select.option>
        </flux:select>

        <flux:select wire:model.live="component" label="{{ __('contents.component') }}">
            @foreach(\App\Models\Content::COMPONENTS as $key => $value)
                <flux:select.option value="{{ $key }}">{{ $value }}</flux:select.option>
            @endforeach
        </flux:select>

        {{-- Show logged in user --}}
        <flux:input label="{{ __('contents.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('contents.create_content') }}
        </flux:button>
    </x-form>
</section>
