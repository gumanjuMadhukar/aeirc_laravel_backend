<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('clients.view_client') }}</x-slot:title>
        <x-slot:subtitle>{{ __('clients.viewing_client', ['title' => $client->client_title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('clients.client_name') }}:</strong> {{ $client->client_name }}
        </div>

        <div>
            <strong>{{ __('clients.type_of_client') }}:</strong> {{ $client->type_of_client }}
        </div>

        <div>
            <strong>{{ __('clients.updated_by') }}:</strong> {{ $client->updated_by }}
        </div>

        <div>
            <strong>{{ __('clients.client_logo') }}:</strong><br>
            @if($client->client_logo)
                <img src="{{ asset('storage/' . $client->client_logo) }}" alt="{{ __('clients.client_detail_logo') }}"
                    class="w-64 mt-2 rounded shadow" />
            @else
                <span class="text-gray-500 italic">{{ __('clients.no_detail_image_available') }}</span>
            @endif
        </div>
    </div>
</section>