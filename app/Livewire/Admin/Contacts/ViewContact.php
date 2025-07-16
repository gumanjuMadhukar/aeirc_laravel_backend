<?php

namespace App\Livewire\Admin\Contacts;

use App\Models\Contact;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewContact extends Component
{
    public Contact $contact;

    public function mount(Contact $contact): void
    {
        $this->authorize('view contacts');
        $this->contact = $contact;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.contacts.view-contact');
    }
}
