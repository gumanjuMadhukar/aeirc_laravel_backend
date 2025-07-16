<?php

namespace App\Livewire\Admin;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Contacts extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'contactDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['address'];

    #[Url]
    public string $search = '';

    // public ?string $role = null;

    public function mount(): void
    {
        $this->authorize('view contacts');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteContact(string $contactId): void
    {

        $this->authorize('delete contacts');

        $contact = Contact::query()->where('id', $contactId)->firstOrFail();

        $contact->delete();

        $this->alert('success', __('contacts.contact_deleted'));

        $this->dispatch('contactDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contacts', [
            'contacts' => Contact::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
