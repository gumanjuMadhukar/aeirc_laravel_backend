<?php

namespace App\Livewire\Admin\GalleryList;

use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditGallery extends Component
{
    use LivewireAlert, WithFileUploads;

    public Gallery $gallery;
    public ?TemporaryUploadedFile $newGalleryImage = null;
    public ?string $gallery_img = null;
    public string $img_name = '';
    public string $updated_by = '';

    public function mount(Gallery $gallery): void
    {
        $this->authorize('update galleryList');
        
        $this->gallery = $gallery;
        $this->gallery_img = $gallery->gallery_img;
        $this->img_name = $gallery->img_name;
        $this->updated_by = $gallery->updated_by;
    }

    public function updateGallery(): void
    {
        $rules = [
            'gallery_img' => 'required|string|max:255',
            'img_name' => 'required|string|max:255',
            'updated_by' => 'nullable|string',
        ];

        if ($this->newGalleryImage) {
            $rules['newGalleryImage'] = 'image|max:2048';
        }

        $this->validate($rules);

        if ($this->newGalleryImage) {
            $this->gallery_img = $this->newGalleryImage->store('images/galleryList', 'public');
        }

        $this->gallery->update([
            'gallery_img' => $this->gallery_img,
            'img_name' => $this->img_name,
            'updated_by' => $this->updated_by,
        ]);

        $this->flash('success', __('galleryList.gallery_updated'));
        $this->redirect(route('admin.galleryList.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.galleryList.edit-gallery');
    }
}
