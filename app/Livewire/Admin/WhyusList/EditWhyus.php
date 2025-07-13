<?php

namespace App\Livewire\Admin\WhyusList;

use App\Models\Whyus;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Validate;
use Livewire\Component;

class EditWhyus extends Component
{
    use LivewireAlert;

    public Whyus $whyus;

    // #[Validate('required|string|max:255')]
    // public string $whyus_component_title = '';

    // #[Validate('required|string|max:255')]
    // public string $whyus_title = '';

    // #[Validate('required|string')]
    // public string $whyus_description = '';

    #[Validate('required|string')]
    public string $item_title = '';

    #[Validate('required|string')]
    public string $item_icon = '';

    #[Validate('required|string')]
    public string $item_description = '';

    #[Validate('nullable|string')]
    public string $updated_by = '';

    public function mount(Whyus $whyus): void
    {
        $this->authorize('update whyus');

        $this->whyus = $whyus;

        // $this->whyus_component_title = $whyus->whyus_component_title;
        // $this->whyus_title = $whyus->whyus_title;
        // $this->whyus_description = $whyus->whyus_description;
        $this->item_title = $whyus->item_title;
        $this->item_icon = $whyus->item_icon;
        $this->item_description = $whyus->item_description;
        $this->updated_by = $whyus->updated_by;
    }

    public function updateWhyus(): void
    {
        $this->validate();

        $this->whyus->update([
            // 'whyus_component_title' => $this->whyus_component_title,
            // 'whyus_title' => $this->whyus_title,
            // 'whyus_description' => $this->whyus_description,
            'item_title' => $this->item_title,
            'item_icon' => $this->item_icon,
            'item_description' => $this->item_description,
            'updated_by' => $this->updated_by,
        ]);

        $this->flash('success', __('whyusList.whyus_updated'));

        $this->redirect(route('admin.whyusList.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.whyusList.edit-whyus');
    }
}
