<?php

namespace App\Livewire\Admin\Banners;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use League\Flysystem\StorageAttributes;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class CreateBanner extends Component
{
    use LivewireAlert, WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $title = 'Create Banner';

    #[Validate('nullable|string')]
    public string $status = '';

    #[Validate('nullable|file|max:1024')]
    // public string $image = '';
    public ?TemporaryUploadedFile $image = null; // or change this to file upload if needed
    #[Validate('nullable|string')]
    public string $name = ''; // or change this to file upload if needed
    #[Validate('nullable|string')]
    public string $description = ''; // or change this to file upload if needed
    #[Validate('nullable|string')]
    public string $category = ''; // or change this to file upload if needed
    #[Validate('nullable|string')]
    public string $updated_by = ''; // or change this to file upload if needed

    public function mount(): void
    {
        $this->authorize('create banners');
    }

    public function createBanner(): void
    {
        $this->validate();

        $path = null;

        if ($this->image) {
            // // Store the uploaded file to storage/app/banners
            // $storedPath = $this->image->store('banners');

            // // Get raw contents and encode to base64
            // $fileContents =  \Storage::get($storedPath);
            // $mimeType = $this->image->getMimeType();
            // $base64Image = 'data:' . $mimeType . ';base64,' . base64_encode($fileContents);
            $path = $this->image->store('images/banners', 'public');
        }
        // dd($path);
        Banner::create([
            'title' => $this->title,
            'name' => $this->name,
            'description' => $this->description,
            'category' => $this->category,
            'status' => $this->status,
            'updated_by' => $this->updated_by,
            'image' => $path,
        ]);

        $this->flash('success', __('banners.banner_created'));

        $this->redirect(route('admin.banners.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.banners.create-banner');
    }
}
