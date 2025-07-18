<?php

namespace App\Livewire\Admin;

use App\Models\SiteSetting;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Sitesettings extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'sitesettingDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['site_title', 'nav_title', 'footer_title','status'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view sitesettings');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteSitesetting(string $sitesettingId): void
    {

        $this->authorize('delete sitesettings');

        $sitesetting = SiteSetting::query()->where('id', $sitesettingId)->firstOrFail();

        $sitesetting->delete();

        $this->alert('success', __('sitesettings.sitesetting_deleted'));

        $this->dispatch('sitesettingDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.sitesettings', [
            'sitesettings' => SiteSetting::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
