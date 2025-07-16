<?php

namespace App\Livewire\Admin;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Clients extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'clientDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['client_name'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view clients');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteClient(string $clientId): void
    {

        $this->authorize('delete clients');

        $client = Client::query()->where('id', $clientId)->firstOrFail();

        $client->delete();

        $this->alert('success', __('clients.client_deleted'));

        $this->dispatch('clientDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.clients', [
            'clients' => Client::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
