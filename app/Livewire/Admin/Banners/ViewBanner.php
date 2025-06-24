<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewBanner extends Component
{
    public Banner $banner;

    public function mount(Banner $banner): void
    {
        $this->authorize('view banners');
        $this->banner = $banner;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.banners.view-banner');
    }
}
