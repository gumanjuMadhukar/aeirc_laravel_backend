<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewService extends Component
{
    public Service $service;

    public function mount(Service $service): void
    {
        $this->authorize('view services');
        $this->service = $service;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.services.view-service');
    }
}
