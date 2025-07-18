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

class EditNavigation extends Component
{
    use HandlesRedirects, LivewireAlert;

    public Navigation $navigation;

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

    public string $updated_by = '';

    public function mount(Navigation $navigation): void
    {
        $this->authorize('update navigations');

        $this->navigation = $navigation;

        $this->label = $navigation->label;
        $this->url = $navigation->url;
        $this->type = $navigation->type;
        $this->order = $navigation->order;
        $this->status = $navigation->status;
        $this->updated_by = $navigation->updated_by ?? '';
    }

    public function updateNavigation(): void
    {
        $this->authorize('update navigations');

        $this->validate();

        $this->navigation->update([
            'label' => $this->label,
            'url' => $this->url,
            'type' => $this->type,
            'order' => $this->order,
            'status' => $this->status,
            'updated_by' => Auth::user()?->name ?? 'system',
        ]);

        $this->flash('success', __('navigations.navigation_edited'));

        $this->redirect(route('admin.navigations.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.navigations.edit-navigation');
    }
}
