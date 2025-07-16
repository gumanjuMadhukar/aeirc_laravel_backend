<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateContent extends Component
{
    use WithFileUploads, LivewireAlert;

    #[Validate('required|string|max:255')]
    public string $headings = '';

    #[Validate('required|string|max:255')]
    public string $sub_headings = '';

    #[Validate('nullable|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|array')]
    public array $features = ['']; // Start with one input

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $image = null;

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $video = null;

    #[Validate('nullable|string|in:active,inactive')]
    public string $status = 'active';

    #[Validate('required|string|in:services,whyus,faq,products,teams,clients,contact,gallery,weatherCard,testimonial,aboutSection,serviceSection')]
    public string $component = '';

    public function mount(): void
    {
        $this->authorize('create contents');
    }

    public function createContent(): void
    {
        $this->validate();

        $imagePath = $this->image?->store('images/contents', 'public');
        $videoPath = $this->video?->store('videos/contents', 'public');

        Content::create([
            'headings' => $this->headings,
            'sub_headings' => $this->sub_headings,
            'title' => $this->title,
            'description' => $this->description,
            'features' => $this->features,
            'image' => $imagePath,
            'video' => $videoPath,
            'status' => $this->status,
            'component' => $this->component,
            'updated_by' => Auth::user()->name ?? 'system',
        ]);

        $this->flash('success', 'Content created successfully.');
        $this->redirect(route('admin.contents.index'), navigate: true);
    }

    public function addFeature(): void
    {
        $this->features[] = '';
    }

    public function removeFeature(int $index): void
    {
        unset($this->features[$index]);
        $this->features = array_values($this->features); // Re-index array
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contents.create-content', [
            'components' => Content::COMPONENTS,
            'statuses' => Content::STATUSES,
        ]);
    }
}
