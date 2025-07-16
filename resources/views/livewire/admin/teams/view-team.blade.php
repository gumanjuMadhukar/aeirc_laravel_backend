<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('teams.view_team') }}</x-slot:title>
        <x-slot:subtitle>{{ __('teams.viewing_team', ['name' => $team->name]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        {{-- Name --}}
        <div>
            <strong>{{ __('teams.name') }}:</strong> {{ $team->name }}
        </div>

        {{-- Position --}}
        <div>
            <strong>{{ __('teams.position') }}:</strong> {{ $team->position }}
        </div>

        {{-- Description --}}
        <div>
            <strong>{{ __('teams.description') }}:</strong> {{ $team->description ?? '—' }}
        </div>

        {{-- Social Media --}}
        <div>
            <strong>{{ __('teams.facebook') }}:</strong>
            @if ($team->facebook)
                <a href="{{ $team->facebook }}" target="_blank" class="text-blue-600 underline">Facebook</a>
            @else
                <span class="text-gray-500 italic">—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('teams.twitter') }}:</strong>
            @if ($team->twitter)
                <a href="{{ $team->twitter }}" target="_blank" class="text-blue-500 underline">Twitter</a>
            @else
                <span class="text-gray-500 italic">—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('teams.instagram') }}:</strong>
            @if ($team->instagram)
                <a href="{{ $team->instagram }}" target="_blank" class="text-pink-600 underline">Instagram</a>
            @else
                <span class="text-gray-500 italic">—</span>
            @endif
        </div>

        <div>
            <strong>{{ __('teams.linkedin') }}:</strong>
            @if ($team->linkedin)
                <a href="{{ $team->linkedin }}" target="_blank" class="text-blue-800 underline">LinkedIn</a>
            @else
                <span class="text-gray-500 italic">—</span>
            @endif
        </div>

        {{-- Updated By --}}
        <div>
            <strong>{{ __('teams.updated_by') }}:</strong> {{ $team->updated_by ?? '-' }}
        </div>

        {{-- Image --}}
        <div>
            <strong>{{ __('teams.image') }}:</strong><br>
            @if($team->image)
                <img src="{{ asset('storage/' . $team->image) }}" alt="Team Image" class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('teams.no_detail_image_available') }}</span>
            @endif
        </div>
    </div>
</section>
