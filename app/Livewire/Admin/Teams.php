<?php

namespace App\Livewire\Admin;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Teams extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'teamDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['name'.'position'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view teams');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteTeam(string $teamId): void
    {

        $this->authorize('delete teams');

        $team = Team::query()->where('id', $teamId)->firstOrFail();

        $team->delete();

        $this->alert('success', __('teams.team_deleted'));

        $this->dispatch('teamDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.teams', [
            'teams' => Team::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
