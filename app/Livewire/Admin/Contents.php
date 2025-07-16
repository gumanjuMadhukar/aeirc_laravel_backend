<?php

namespace App\Livewire\Admin;

use App\Models\Content;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Contents extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'contentDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['title', 'heading','sub_heading', 'heading','updated_by'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view contents');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteContent(string $contentId): void
    {

        $this->authorize('delete contents');

        $content = Content::query()->where('id', $contentId)->firstOrFail();

        $content->delete();

        $this->alert('success', __('contents.content_deleted'));

        $this->dispatch('contentDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contents', [
            'contents' => Content::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
