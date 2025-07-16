<?php

namespace App\Livewire\Admin\Clients;

use Livewire\WithFileUploads;
use Livewire\Component;
use App\Models\Client;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateClient extends Component
{
    use LivewireAlert, WithFileUploads;

    public ?TemporaryUploadedFile $client_logo = null;
    public string $client_name = '';
    public string $type_of_client = '';

    public function mount(): void
    {
        $this->authorize('create clients');  
    }

    public function createClient(): void
    {
        $this->validate([
            'client_logo' => 'required|image|max:2048',
            'client_name' => 'required|string|max:255',
            'type_of_client' => 'required|in:national,international',
        ]);

        $clientImagePath = $this->client_logo
            ? $this->client_logo->store('images/clients', 'public')
            : null;

        Client::create([
            'client_logo' => $clientImagePath,
            'client_name' => $this->client_name,
            'type_of_client' => $this->type_of_client,
            'updated_by' => auth()->user()->name, // ✅ Automatically set
        ]);

        $this->flash('success', __('clients.client_created'));
        $this->redirect(route('admin.clients.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.clients.create-client');
    }
}
