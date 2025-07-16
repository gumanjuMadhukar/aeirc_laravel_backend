<?php

namespace App\Livewire\Admin;

use App\Models\Gallery;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class GalleryList extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'galleryDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['img_name'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view galleryList');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteGallery(string $galleryId): void
    {

        $this->authorize('delete galleryList');

        $gallery = Gallery::query()->where('id', $galleryId)->firstOrFail();

        $gallery->delete();

        $this->alert('success', __('galleryList.gallery_deleted'));

        $this->dispatch('galleryDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.galleryList', [
            'galleryList' => Gallery::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
