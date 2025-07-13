<?php

namespace App\Livewire\Admin\WhyusList;

use App\Models\Whyus;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewWhyus extends Component
{
    public Whyus $whyus;

    public function mount(Whyus $whyus): void
    {
        $this->authorize('view whyus');
        $this->whyus = $whyus;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.whyusList.view-whyus');
    }
}
