<?php

namespace App\Livewire\Admin\Sitesettings;

use App\Models\Sitesetting;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewSitesetting extends Component
{
    public Sitesetting $sitesetting;

    public function mount(Sitesetting $sitesetting): void
    {
        $this->authorize('view sitesettings');
        $this->sitesetting = $sitesetting;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.sitesettings.view-sitesetting');
    }
}
