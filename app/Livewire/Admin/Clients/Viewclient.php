<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewClient extends Component
{
    public Client $client;

    public function mount(Client $client): void
    {
        $this->authorize('view clients');
        $this->client = $client;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.clients.view-client');
    }
}
