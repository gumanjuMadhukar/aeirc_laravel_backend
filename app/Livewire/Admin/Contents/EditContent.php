<?php

namespace App\Livewire\Admin\Contents;

use App\Models\Content;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditContent extends Component
{
    use HandlesRedirects, LivewireAlert, WithFileUploads;

    public Content $content;

    #[Validate('required|string|max:255')]
    public string $headings = '';

    #[Validate('required|string|max:255')]
    public string $sub_headings = '';

    #[Validate('nullable|string|max:255')]
    public string $title = '';

    #[Validate('nullable|string')]
    public string $description = '';

    #[Validate('nullable|array')]
    public array $features = [];

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $newImage = null;

    #[Validate('nullable|file|max:2048')]
    public ?TemporaryUploadedFile $newVideo = null;

    #[Validate('nullable|string')]
    public string $image = '';

    #[Validate('nullable|string')]
    public string $video = '';

    #[Validate('nullable|string|in:active,inactive')]
    public string $status = 'active';

    #[Validate('required|string|in:services,whyus,faq,products,teams,clients,contact,gallery,weatherCard,testimonial,aboutSection,serviceSection')]
    public string $component = '';

    #[Validate('nullable|string')]
    public string $updated_by = '';

    public function mount(Content $content): void
    {
        $this->authorize('update contents');

        $this->content = $content;

        $this->headings = $content->headings;
        $this->sub_headings = $content->sub_headings;
        $this->title = $content->title ?? '';
        $this->description = $content->description ?? '';
        $this->features = $content->features ?? [];
        $this->image = $content->image ?? '';
        $this->video = $content->video ?? '';
        $this->status = $content->status ?? 'active';
        $this->component = $content->component ?? '';
        $this->updated_by = $content->updated_by ?? '';
    }

    public function updateContent(): void
    {
        $this->authorize('update contents');

        $this->validate();

        if ($this->newImage) {
            $this->image = $this->newImage->store('images/contents', 'public');
        }

        if ($this->newVideo) {
            $this->video = $this->newVideo->store('videos/contents', 'public');
        }

        $this->content->update([
            'headings' => $this->headings,
            'sub_headings' => $this->sub_headings,
            'title' => $this->title,
            'description' => $this->description,
            'features' => $this->features,
            'image' => $this->image,
            'video' => $this->video,
            'status' => $this->status,
            'component' => $this->component,
            'updated_by' => Auth::user()->name ?? 'system',
        ]);

        $this->flash('success', 'Content updated successfully.');

        $this->redirect(route('admin.contents.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contents.edit-content', [
            'components' => Content::COMPONENTS,
            'statuses' => Content::STATUSES,
        ]);
    }
}
