<?php

namespace App\Livewire\Client;

use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class Php extends Component
{

    public function mount(): void
    {
        //
    }

    #[Layout('components.layouts.app')]
    public function render(): View
    {
        return view('livewire.client.php');
    }
}
