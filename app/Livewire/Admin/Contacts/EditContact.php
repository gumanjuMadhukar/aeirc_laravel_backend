<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditContact extends Component
{
    use LivewireAlert, WithFileUploads;

    public Contact $contact;


    public string $address = '';
    public string $mobile = '';
    public string $email = '';
    public string $map_iframe = '';

    public function mount(Contact $contact): void
    {
        $this->authorize('update contacts');

        $this->contact = $contact;
        $this->address = $contact->address;
        $this->mobile = $contact->mobile;
        $this->email = $contact->email ?? '';
        $this->map_iframe = $contact->map_iframe ?? '';
    }

    public function updateContact(): void
    {
        $this->validate([
            'address' => 'required|string|max:255',
            'mobile' => 'required|string|max:255',
            'email' => 'nullable|string',
            'map_iframe' => 'nullable|string',
        ]);

        $this->contact->update([
            'address' => $this->address,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'map_iframe' => $this->map_iframe,
            'updated_by' => auth()->user()->name,
        ]);

        $this->flash('success', __('contacts.contact_updated'));
        $this->redirect(route('admin.contacts.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contacts.edit-contact');
    }
}
