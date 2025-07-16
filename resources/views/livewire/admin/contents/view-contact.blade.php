<section class="w-full">
    <x-page-heading>
        <x-slot:title>{{ __('contacts.view_contact') }}</x-slot:title>
        <x-slot:subtitle>{{ __('contacts.viewing_contact', ['title' => $contact->contact_title]) }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>{{ __('contacts.address') }}:</strong> {{ $contact->address }}
        </div>

        <div>
            <strong>{{ __('contacts.mobile') }}:</strong> {{ $contact->mobile }}
        </div>
        <div>
            <strong>{{ __('contacts.email') }}:</strong> {{ $contact->email }}
        </div>
        <div>
            <strong>{{ __('contacts.map_iframe') }}:</strong> {{ $contact->map_iframe }}
        </div>

        <div>
            <strong>{{ __('contacts.updated_by') }}:</strong> {{ $contact->updated_by }}
        </div>

    </div>
</section>