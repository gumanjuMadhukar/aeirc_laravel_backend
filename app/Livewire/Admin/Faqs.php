<?php

namespace App\Livewire\Admin;

use App\Models\Faq;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

class Faqs extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'faqDeleted' => '$refresh',
    ];

    #[Session]
    public int $perPage = 10;

    /** @var array<int,string> */
    public array $searchableFields = ['question','answer'];

    #[Url]
    public string $search = '';

    public function mount(): void
    {
        $this->authorize('view faq');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteFaq(string $faqId): void
    {
        $this->authorize('delete faq');

        $faq = Faq::query()->where('id', $faqId)->firstOrFail();

        $faq->delete();

        $this->alert('success', __('faqs.faq_deleted'));

        $this->dispatch('faqDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.faqs', [
            'faqs' => Faq::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
                ->paginate($this->perPage),
        ]);
    }
}
