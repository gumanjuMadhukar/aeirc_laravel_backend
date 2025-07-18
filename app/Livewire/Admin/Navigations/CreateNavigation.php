<?php

namespace App\Livewire\Admin\Navigations;

use App\Models\Navigation;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\Features\SupportRedirects\HandlesRedirects;

class CreateNavigation extends Component
{
    use HandlesRedirects, LivewireAlert;

    #[Validate(['required', 'string', 'max:255'])]
    public string $label = '';

    #[Validate(['required', 'string', 'max:255'])]
    public string $url = '';

    #[Validate(['required', 'string', 'in:navbar,footer,both'])]
    public string $type = 'navbar';

    #[Validate('nullable|integer')]
    public ?int $order = 0;

    #[Validate(['required', 'string', 'in:active,inactive'])]
    public string $status = 'active';

    public function mount(): void
    {
        $this->authorize('create navigations');
    }

    public function createNavigation(): void
    {
        $this->validate();

        Navigation::create([
            'label' => $this->label,
            'url' => $this->url,
            'type' => $this->type,
            'order' => $this->order,
            'status' => $this->status,
            'updated_by' => Auth::user()?->name ?? 'system',
        ]);

        $this->flash('success', __('navigations.navigation_created'));

        $this->redirect(route('admin.navigations.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.navigations.create-navigation');
    }
}
