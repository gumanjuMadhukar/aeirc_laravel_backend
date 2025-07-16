<?php

namespace App\Livewire\Admin\GalleryList;

use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewGallery extends Component
{
    public Gallery $gallery;

    public function mount(Gallery $gallery): void
    {
        $this->authorize('view galleryList');
        $this->gallery = $gallery;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.galleryList.view-gallery');
    }
}
