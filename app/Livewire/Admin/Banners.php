<?php

namespace App\Livewire\Admin;

use App\Models\Banner;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Session;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class Banners extends Component
{
    use LivewireAlert;
    use WithPagination;

    /** @var array<string,string> */
    protected $listeners = [
        'bannerDeleted' => '$refresh',
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
        $this->authorize('view banners');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function deleteBanner(string $bannerId): void
    {

        $this->authorize('delete banners');

        $banner = Banner::query()->where('id', $bannerId)->firstOrFail();

        $banner->delete();

        $this->alert('success', __('banners.banner_deleted'));

        $this->dispatch('bannerDeleted');
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.banners', [
            'banners' => Banner::query()
                ->when($this->search, function ($query, $search): void {
                    $query->whereAny($this->searchableFields, 'LIKE', "%$search%");
                })
            ->paginate($this->perPage),
        ]);
    }
}
