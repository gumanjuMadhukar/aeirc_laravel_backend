<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditFaq extends Component
{
    use LivewireAlert;

    public Faq $faq;

    #[Validate('required|string')]
    public string $question = '';

    #[Validate('required|string')]
    public string $answer = '';

    #[Validate('nullable|string')]
    public string $updated_by = '';

    public function mount(Faq $faq): void
    {
        $this->authorize('update faq');

        $this->faq = $faq;
        $this->question = $faq->question;
        $this->answer = $faq->answer;
        $this->updated_by = $faq->updated_by;
    }

    public function updateFaq(): void
    {
        $this->validate();

        $this->faq->update([
            'question' => $this->question,
            'answer' => $this->answer,
            'updated_by' => $this->updated_by,
        ]);

        $this->flash('success', __('faqs.faq_updated'));

        $this->redirect(route('admin.faqs.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.faqs.edit-faq');
    }
}
