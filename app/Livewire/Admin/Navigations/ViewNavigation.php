<?php

namespace App\Livewire\Admin\Navigations;

use App\Models\Navigation;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewNavigation extends Component
{
    public Navigation $navigation;

    public function mount(Navigation $navigation): void
    {
        $this->authorize('view navigations');
        $this->navigation = $navigation;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.navigations.view-navigation');
    }
}
