<?php

namespace App\Livewire\Admin;

use App\Models\Whyus;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class WhyusList extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'whyusDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['item_title'];

    #[Url]
    public string $search = '';

    public function mount(): void
    {
        $this->authorize('view whyus');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteWhyus(string $whyusId): void
    {
        $this->authorize('delete whyus');

        $whyus = Whyus::query()->where('id', $whyusId)->firstOrFail();

        $whyus->delete();

        $this->alert('success', __('whyusList.whyus_deleted'));

        $this->dispatch('whyusDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.whyusList', [
            'whyusList' => Whyus::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
                ->paginate($this->perPage),
        ]);
    }
}
