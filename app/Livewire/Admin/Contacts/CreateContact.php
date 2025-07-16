<?php

namespace App\Livewire\Admin\Contacts;

use Livewire\Component;
use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateContact extends Component
{
    use LivewireAlert;

    public string $address = '';
    public string $mobile = '';
    public string $email = '';
    public string $map_iframe = '';

    public function mount(): void
    {
        $this->authorize('create contacts');
    }

    public function createContact(): void
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'map_iframe' => 'required|string',

        ]);

        Contact::create([
            'address' => $this->address,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'map_iframe' => $this->map_iframe,
            'updated_by' => auth()->user()->name,
        ]);

        $this->flash('success', __('contact.contact_created'));
        $this->redirect(route('admin.contacts.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contacts.create-contact');
    }
}
