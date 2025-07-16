<?php

namespace App\Livewire\Admin\Teams;

use App\Models\Team;
use Illuminate\Contracts\View\View;
use Livewire\Attributes\Layout;
use Livewire\Component;

class ViewTeam extends Component
{
    public Team $team;

    public function mount(Team $team): void
    {
        $this->authorize('view teams');
        $this->team = $team;
    }

    #[Layout('components.layouts.admin')]
    public function render(): View
    {
        return view('livewire.admin.teams.view-team');
    }
}
