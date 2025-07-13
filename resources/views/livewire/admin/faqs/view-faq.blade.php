<section class="w-full">
    <x-page-heading>
        <x-slot:title>View Faq</x-slot:title>
        <x-slot:subtitle>Viewing faq: {{ $faq->item_title }}</x-slot:subtitle>
    </x-page-heading>

    <div class="mt-6 space-y-4">
        <div>
            <strong>Questions</strong> {{ $faq->question }}
        </div>

        <div>
            <strong>answer</strong> <i class="{{ $faq->item_icon }}"></i> ({{ $faq->answer}})
        </div>

        <div>
            <strong>Updated By:</strong> {{ $faq->updated_by }}
        </div>
    </div>
</section>
