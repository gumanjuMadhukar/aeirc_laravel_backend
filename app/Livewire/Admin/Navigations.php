<?php

namespace App\Livewire\Admin;

use App\Models\Navigation;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class NAvigations extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'navigationDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['label', 'status'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view navigations');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteNavigation(string $navigationId): void
    {

        $this->authorize('delete navigations');

        $navigation = Navigation::query()->where('id', $navigationId)->firstOrFail();

        $navigation->delete();

        $this->alert('success', __('navigations.navigation_deleted'));

        $this->dispatch('navigationDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.navigations', [
            'navigations' => Navigation::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
