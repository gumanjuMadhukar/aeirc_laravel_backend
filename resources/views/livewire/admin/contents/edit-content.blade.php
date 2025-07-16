<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contents.edit_content') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contents.edit_content_description') }}</x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit.prevent="updateContent" class="space-y-6">
        <flux:input wire:model="headings" label="{{ __('contents.headings') }}" />
        <flux:input wire:model="sub_headings" label="{{ __('contents.sub_headings') }}" />
        <flux:input wire:model="title" label="{{ __('contents.title') }}" />
        <flux:input wire:model="description" label="{{ __('contents.description') }}" type="textarea" />

        <!-- Features List Input -->
        <div>
            <label class="block text-sm mb-1">{{ __('contents.features') }}</label>

            <div class="space-y-3">
                @foreach ($features as $index => $feature)
                    <div class="flex items-center gap-3">
                        <input wire:model.live="features.{{ $index }}" type="text"
                            placeholder="{{ __('contents.enter_feature') }}"
                            class="block w-full rounded-md border border-gray-300 shadow-sm px-3 py-2 placeholder-gray-400
                                       focus:border-blue-500 focus:ring focus:ring-blue-300 focus:ring-opacity-50 sm:text-sm" />
                        @if(count($features) > 1)
                            <button type="button" wire:click="removeFeature({{ $index }})"
                                class="text-red-600 hover:text-red-800 transition-colors duration-200 rounded px-2 py-1 text-sm"
                                aria-label="Remove feature">
                                ✖
                            </button>
                        @endif
                    </div>
                @endforeach
            </div>

            <button type="button" wire:click="addFeature"
                class="mt-2 text-blue-600 hover:text-blue-800 text-sm font-semibold focus:outline-none focus:underline">
                + {{ __('content.add_more_features') }}
            </button>
        </div>

        <!-- Existing Image Preview -->
        @if ($image && !is_string($image) && $image->temporaryUrl())
            <div class="mt-2">
                <label class="block text-sm mb-1">{{ __('contents.current_image') }}</label>
                <img src="{{ $image->temporaryUrl() }}" alt="Preview"
                    class="rounded shadow w-[200px] h-[80px] object-cover">
            </div>
        @elseif (is_string($image))
            <div class="mt-2">
                <label class="block text-sm mb-1">{{ __('contents.current_image') }}</label>
                <img src="{{ asset('storage/' . $image) }}" alt="Current Image"
                    class="rounded shadow w-[200px] h-[80px] object-cover">
            </div>
        @endif

        <flux:input wire:model="newImage" label="{{ __('contents.image') }}" type="file" />

        <!-- Existing Video Preview -->
        @if ($video && !is_string($video) && $video->temporaryUrl())
            <div class="mt-4">
                <label class="block text-sm mb-1">{{ __('contents.current_video') }}</label>
                <video class="w-[300px] rounded shadow" controls>
                    <source src="{{ $video->temporaryUrl() }}" type="video/mp4">
                    {{ __('contents.video_not_supported') }}
                </video>
            </div>
        @elseif (is_string($video))
            <div class="mt-4">
                <label class="block text-sm mb-1">{{ __('contents.current_video') }}</label>
                <video class="w-[300px] rounded shadow" controls>
                    <source src="{{ asset('storage/' . $video) }}" type="video/mp4">
                    {{ __('contents.video_not_supported') }}
                </video>
            </div>
        @endif

        <flux:input wire:model="newVideo" label="{{ __('contents.video') }}" type="file" />


        <flux:select wire:model="status" label="{{ __('contents.status') }}">
            <flux:select.option value="active">Active</flux:select.option>
            <flux:select.option value="inactive">Inactive</flux:select.option>
        </flux:select>

        <flux:select wire:model="component" label="{{ __('contents.component') }}">
            @foreach(\App\Models\Content::COMPONENTS as $key => $value)
                <flux:select.option value="{{ $key }}">{{ $value }}</flux:select.option>
            @endforeach
        </flux:select>

        {{-- Updated By - readonly --}}
        <flux:input label="{{ __('contents.updated_by') }}" value="{{ auth()->user()->name }}" readonly disabled />

        {{-- Hidden input for Livewire binding --}}
        <input type="hidden" wire:model="updated_by" value="{{ auth()->user()->name }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('contents.edit_content') }}
        </flux:button>
    </x-form>
</section>