<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('services.view_service') }}</x-slot:title>
        <x-slot:subtitle>{{ __('services.viewing_service', ['title' => $service->component_title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('services.component_title') }}:</strong> {{ $service->component_title }}
        </div>

        <div>
            <strong>{{ __('services.description') }}:</strong> {{ $service->description }}
        </div>

        <div>
            <strong>{{ __('services.description_for_list') }}:</strong> {{ $service->description_for_list }}
        </div>

        <div>
            <strong>{{ __('services.list') }}:</strong> {{ $service->list }}
        </div>

        <div>
            <strong>{{ __('services.service_icon') }}:</strong> {{ $service->service_icon }}
        </div>

        <div>
            <strong>{{ __('services.service_name') }}:</strong> {{ $service->service_name }}
        </div>

        <div>
            <strong>{{ __('services.service_description') }}:</strong> {{ $service->service_description }}
        </div>

        <div>
            <strong>{{ __('services.service_features') }}:</strong>
            @php
                $features = array_filter(array_map('trim', explode(',', $service->service_features ?? '')));
            @endphp
            @if(count($features) > 0)
                <ul class="list-disc list-inside ml-4">
                    @foreach($features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            @else
                <span class="text-gray-500 italic">{{ __('services.no_features') }}</span>
            @endif
        </div>

        <div>
            <strong>{{ __('services.updated_by') }}:</strong> {{ $service->updated_by }}
        </div>

        <div>
            <strong>{{ __('services.main_image') }}:</strong><br>
            @if($service->image)
                <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->component_title }}" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('services.no_image_available') }}</span>
            @endif
        </div>

        <div>
            <strong>{{ __('services.service_detail_image') }}:</strong><br>
            @if($service->service_image)
                <img src="{{ asset('storage/' . $service->service_image) }}" alt="{{ __('services.service_detail_image') }}" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('services.no_detail_image_available') }}</span>
            @endif
        </div>
    </div>
</section>
