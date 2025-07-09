<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditBanner extends Component
{
    use HandlesRedirects, LivewireAlert, WithFileUploads;

    public Banner $banner;

    #[Validate(['required', 'string', 'max:255'])]
    public string $title = '';

    #[Validate(['required', 'in:active,inactive'])]
    public string $status = 'active';

    #[Validate('nullable|file|max:1024')]
    public ?TemporaryUploadedFile $newImage = null;

    #[Validate('nullable|string')]
    public string $image = ''; // current image path

    #[Validate('nullable|string')]

    public string $name = '';

    #[Validate('nullable|string')]
    public string $description = '';


    #[Validate('nullable|string')]
    public string $category = '';

    #[Validate('required|string|in:home,about,contact,services,products')]
    public string $page = '';

    #[Validate('nullable|string')]
    public string $updated_by = '';

    // When editing, populate the form with the current banner's data
    public function mount(Banner $banner): void
    {
        $this->authorize('update banners');

        $this->banner = $banner;
        $this->title = $banner->title;
        $this->status = $banner->status;
        $this->image = $banner->image ?? '';
        $this->name = $banner->name ?? '';
        $this->description = $banner->description ?? '';
        $this->category = $banner->category ?? '';
        $this->page = $banner->page ?? '';
        $this->updated_by = $banner->updated_by ?? '';
    }

    public function updateBanner(): void
    {
        $this->authorize('update banners');

        $this->validate();

        // Handle new image upload
        $imagePath = $this->image;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('images/banners', 'public');
        }

        $this->banner->update([
            'title' => $this->title,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'status' => $this->status,
            'page' => $this->page,
            'updated_by' => $this->updated_by,
            'image' => $imagePath,
        ]);

        $this->flash('success', __('banners.banner_edited'));

        $this->redirect(route('admin.banners.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.banners.edit-banner');
    }
}
