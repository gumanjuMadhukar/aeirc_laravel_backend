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

class CreateService extends Component
{
    use LivewireAlert, WithFileUploads;

    #[Validate('required|string|max:255')]
    public string $component_title = '';

    #[Validate('required|string|max:255')]
    public string $service_name = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|string')]
    public string $description_for_list = '';

    #[Validate('nullable|string')]
    public string $list = '';

    #[Validate('nullable|string')]
    public string $service_icon = '';

    #[Validate('nullable|string')]
    public string $service_description = '';

    #[Validate('nullable|array')]
    public array $service_features = ['']; 

    #[Validate('nullable|string')]
    public string $updated_by = '';

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $image = null;

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $service_image = null;

    public function mount(): void
    {
        $this->authorize('create services');  
    }

    public function addFeature(): void
    {
        $this->service_features[] = '';
    }

    public function removeFeature($index): void
    {
        unset($this->service_features[$index]);
        $this->service_features = array_values($this->service_features); 
    }

    public function createService(): void
    {
        $this->validate();

        $imagePath = $this->image ? $this->image->store('images/services', 'public') : null;
        $serviceImagePath = $this->service_image ? $this->service_image->store('images/services', 'public') : null;

        Service::create([
            'component_title' => $this->component_title,
            'service_name' => $this->service_name,
            'description' => $this->description,
            'description_for_list' => $this->description_for_list,
            'list' => $this->list,
            'service_icon' => $this->service_icon,
            'service_description' => $this->service_description,
            'service_features' => implode(',', array_filter($this->service_features)),
            'updated_by' => $this->updated_by,
            'image' => $imagePath,
            'service_image' => $serviceImagePath,
        ]);

        $this->flash('success', __('services.service_created'));

        $this->redirect(route('admin.services.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.services.create-service');
    }
}
