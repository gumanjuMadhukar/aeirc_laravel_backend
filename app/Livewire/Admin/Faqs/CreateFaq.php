<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class CreateFaq extends Component
{
    use LivewireAlert;

    #[Validate('required|string')]
    public string $question = '';

    #[Validate('required|string')]
    public string $answer = '';

    #[Validate('nullable|string')]
    public string $updated_by = '';

    public function mount(): void
    {
        $this->authorize('create faq');
    }

    public function createFaq(): void
    {
        $this->validate();

        Faq::create([
            'question' => $this->question,
            'answer' => $this->answer,
            'updated_by' => $this->updated_by,
        ]);

        $this->flash('success', __('faqs.faq_created'));

        $this->redirect(route('admin.faqs.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.faqs.create-faq');
    }
}
