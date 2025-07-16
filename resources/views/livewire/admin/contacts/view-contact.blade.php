<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('content.view_content') }}</x-slot:title>
        <x-slot:subtitle>{{ __('content.viewing_content', ['title' => $content->title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('content.headings') }}:</strong> {{ $content->headings }}
        </div>

        <div>
            <strong>{{ __('content.sub_headings') }}:</strong> {{ $content->sub_headings }}
        </div>

        <div>
            <strong>{{ __('content.title') }}:</strong> {{ $content->title }}
        </div>

        <div>
            <strong>{{ __('content.description') }}:</strong> {{ $content->description }}
        </div>

        <div>
            <strong>{{ __('content.features') }}:</strong>
            @if(is_array($content->features) && count($content->features))
                <ul class="list-disc list-inside">
                    @foreach($content->features as $feature)
                        <li>{{ $feature }}</li>
                    @endforeach
                </ul>
            @else
                <span>—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('content.image') }}:</strong>
            @if ($content->image)
                <img src="{{ asset('storage/' . $content->image) }}" alt="Content Image" class="mt-2 rounded w-48 h-auto">
            @else
                <span>—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('content.video') }}:</strong>
            @if ($content->video)
                <a href="{{ $content->video }}" target="_blank" class="text-blue-600 underline">View Video</a>
            @else
                <span>—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('content.status') }}:</strong> {{ ucfirst($content->status) }}
        </div>

        <div>
            <strong>{{ __('content.component') }}:</strong> {{ \App\Models\Content::COMPONENTS[$content->component] ?? $content->component }}
        </div>

        <div>
            <strong>{{ __('content.updated_by') }}:</strong> {{ $content->updated_by }}
        </div>
    </div>
</section>
