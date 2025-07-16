<?php

namespace App\Livewire\Admin\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class EditTeam extends Component
{
    use LivewireAlert, WithFileUploads;

    public Team $team;

    public ?TemporaryUploadedFile $newImage = null;

    public string $name = '';
    public string $position = '';
    public string $description = '';
    public string $facebook = '';
    public string $twitter = '';
    public string $instagram = '';
    public string $linkedin = '';
    public string $image = ''; // Existing image path (for preview)

    public function mount(Team $team): void
    {
        $this->authorize('update teams');

        $this->team = $team;
        $this->name = $team->name;
        $this->position = $team->position;
        $this->description = $team->description ?? '';
        $this->facebook = $team->facebook ?? '';
        $this->twitter = $team->twitter ?? '';
        $this->instagram = $team->instagram ?? '';
        $this->linkedin = $team->linkedin ?? '';
        $this->image = $team->image; // for preview
    }

    public function updateTeam(): void
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'description' => 'nullable|string',
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'newImage' => 'nullable|image|max:2048',
        ]);

        $imagePath = $this->image;

        if ($this->newImage) {
            $imagePath = $this->newImage->store('images/teams', 'public');
        }

        $this->team->update([
            'name' => $this->name,
            'position' => $this->position,
            'description' => $this->description,
            'facebook' => $this->facebook,
            'twitter' => $this->twitter,
            'instagram' => $this->instagram,
            'linkedin' => $this->linkedin,
            'image' => $imagePath,
            'updated_by' => auth()->user()->name,
        ]);

        $this->flash('success', __('teams.team_updated'));
        $this->redirect(route('admin.teams.index'), true);
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.teams.edit-team');
    }
}
