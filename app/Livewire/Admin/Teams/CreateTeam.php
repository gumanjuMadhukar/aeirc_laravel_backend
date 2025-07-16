<?php

namespace App\Livewire\Admin\Teams;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Attributes\Layout;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class CreateTeam extends Component
{
    use LivewireAlert, WithFileUploads;

    public ?TemporaryUploadedFile $image = null;
    public string $name = '';
    public string $position = '';
    public string $description = '';
    public string $facebook = '';
    public string $twitter = '';
    public string $instagram = '';
    public string $linkedin = '';

    public function mount(): void
    {
        $this->authorize('create teams');
    }

    public function createTeam(): void
    {
        $this->validate([
            'image' => 'required|image|max:2048',
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
        ]);

        $imagePath = $this->image
            ? $this->image->store('images/teams', 'public')
            : null;

        Team::create([
            'image' => $imagePath,
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'updated_by' => auth()->user()->name,
        ]);

        $this->flash('success', __('teams.team_created'));
        $this->redirect(route('admin.teams.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.teams.create-team');
    }
}
