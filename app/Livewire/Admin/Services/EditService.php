<?php

namespace App\Livewire\Admin\Services;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditService extends Component
{
    use LivewireAlert, WithFileUploads;

    public Service $service;

    #[Validate('required|string|max:255')]
    public string $component_title = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $description_for_list = '';

    #[Validate('nullable|string')]
    public string $list = '';

    #[Validate('nullable|string')]
    public string $service_icon = '';

    #[Validate('nullable|string')]
    public string $service_name = '';

    #[Validate('nullable|string')]
    public string $service_description = '';

    // This is an array to hold individual features in the form
    public array $service_features = [];

    #[Validate('nullable|string')]
    public string $updated_by = '';

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $newImage = null;

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $newServiceImage = null;

    public ?string $image = null; // current main image path
    public ?string $service_image = null; // current service detail image path

    public function mount(Service $service): void
    {
        $this->authorize('update services');

        $this->service = $service;
        $this->component_title = $service->component_title;
        $this->description = $service->description;
        $this->description_for_list = $service->description_for_list;
        $this->list = $service->list;
        $this->service_icon = $service->service_icon;
        $this->service_name = $service->service_name;
        $this->service_description = $service->service_description;
        $this->updated_by = $service->updated_by;
        $this->image = $service->image;
        $this->service_image = $service->service_image;

        // Convert CSV string to array for editing
        $this->service_features = $service->service_features
            ? explode(',', $service->service_features)
            : ['']; // default empty field if none
    }

    // Add a new empty feature input
    public function addFeature(): void
    {
        $this->service_features[] = '';
    }

    // Remove feature at index
    public function removeFeature(int $index): void
    {
        unset($this->service_features[$index]);
        $this->service_features = array_values($this->service_features); // reindex array
    }

    public function updateService(): void
    {
        $this->validate();

        // Handle new main image upload
        if ($this->newImage) {
            $this->image = $this->newImage->store('images/services', 'public');
        }

        // Handle new service detail image upload
        if ($this->newServiceImage) {
            $this->service_image = $this->newServiceImage->store('images/services', 'public');
        }

        $this->service->update([
            'component_title' => $this->component_title,
            'description' => $this->description,
            'description_for_list' => $this->description_for_list,
            'list' => $this->list,
            'service_icon' => $this->service_icon,
            'service_name' => $this->service_name,
            'service_description' => $this->service_description,
            // Join features array to comma separated string for DB
            'service_features' => implode(',', array_filter($this->service_features)),
            'updated_by' => $this->updated_by,
            'image' => $this->image,
            'service_image' => $this->service_image,
        ]);

        $this->flash('success', __('services.service_updated'));

        $this->redirect(route('admin.services.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.services.edit-service');
    }
}
