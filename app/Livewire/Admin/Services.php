<?php

namespace App\Livewire\Admin;

use App\Models\Service;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Services extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'serviceDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['title', 'status'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view services');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteService(string $serviceId): void
    {

        $this->authorize('delete services');

        $service = Service::query()->where('id', $serviceId)->firstOrFail();

        $service->delete();

        $this->alert('success', __('services.service_deleted'));

        $this->dispatch('serviceDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.services', [
            'services' => Service::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
