<section class="w-full">
    <x-page-heading>
        <x-slot:title>
            {{ __('faqs.edit_faq') }}
        </x-slot:title>
        <x-slot:subtitle>
            {{ __('faqs.edit_faq_description') }}
        </x-slot:subtitle>
    </x-page-heading>

    <x-form wire:submit="updateFaq" class="space-y-6">

        <flux:input wire:model.live="question" label="{{ __('faqs.question') }}" />
        <flux:input wire:model.live="answer" label="{{ __('faqs.answer') }}" />
        <flux:input wire:model.live="updated_by" label="{{ __('faqs.updated_by') }}" />

        <flux:button type="submit" icon="save" variant="primary">
            {{ __('faqs.edit_faq') }}
        </flux:button>
    </x-form>
</section>
