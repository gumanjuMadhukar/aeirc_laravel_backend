<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Content;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewContent extends Component
{
    public Content $content;

    public function mount(Content $content): void
    {
        $this->authorize('view contents');
        $this->content = $content;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contents.view-content');
    }
}
