<?php

namespace App\Livewire\Admin\Clients;

use App\Models\Client;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class EditClient extends Component
{
    use LivewireAlert, WithFileUploads;

    public Client $client;
    public ?TemporaryUploadedFile $newClientImage = null;
    public ?string $client_logo = null;
    public string $client_name = '';
    public string $type_of_client = '';

    public function mount(Client $client): void
    {
        $this->authorize('update clients');
        
        $this->client = $client;
        $this->client_logo = $client->client_logo;
        $this->client_name = $client->client_name;
        $this->type_of_client = $client->type_of_client;
        $this->updated_by = $client->updated_by;
    }

public function updateClient(): void
{
    $rules = [
        'client_name' => 'required|string|max:255',
        'type_of_client' => 'required|in:national,international',
        'newClientImage' => 'nullable|image|max:2048',
    ];

    $this->validate($rules);

    if ($this->newClientImage) {
        $this->client_logo = $this->newClientImage->store('images/clients', 'public');
    }

    $this->client->update([
        'client_name' => $this->client_name,
        'client_logo' => $this->client_logo,
        'type_of_client' => $this->type_of_client,
        'updated_by' => auth()->user()->name,
    ]);

    $this->flash('success', __('clients.client_updated'));
    $this->redirect(route('admin.clients.index'), true);
}


    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.clients.edit-client');
    }
}
