<?php

namespace App\Livewire\Admin\GalleryList;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateGallery extends Component
{
    use LivewireAlert, WithFileUploads;
    public ?TemporaryUploadedFile $gallery_img = null;
    public string $img_name = '';
    public string $updated_by = '';

    public function mount(): void
    {
        $this->authorize('create galleryList');  
    }

    public function createGallery(): void
    {
        $this->validate([
            'gallery_img' => 'required|image|max:2048',
            'img_name' => 'required|string|max:255',
            'updated_by' => 'nullable|string|max:255',
        ]);

        $galleryImagePath = $this->gallery_img
            ? $this->gallery_img->store('images/galleryList', 'public')
            : null;

        Gallery::create([
            'gallery_img' => $galleryImagePath,
            'img_name' => $this->img_name,
            'updated_by' => $this->updated_by,
        ]);

        $this->flash('success', __('galleryList.gallery_created'));
        $this->redirect(route('admin.galleryList.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.galleryList.create-gallery');
    }
}
?>