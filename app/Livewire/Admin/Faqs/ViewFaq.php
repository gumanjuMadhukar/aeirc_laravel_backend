<?php

namespace App\Livewire\Admin\Faqs;

use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewFaq extends Component
{
    public Faq $faq;

    public function mount(Faq $faq): void
    {
        $this->authorize('view faq');
        $this->faq = $faq;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.faqList.view-faq');
    }
}
