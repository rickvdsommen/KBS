<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Project;

class Projects extends Component
{
    public $projects;

    public function render()
    {
        return view('livewire.projects');
    }

    public function mount()
    {
        $this->refreshItems();
    }

    public function refreshItems()
    {
        $this->projects = Project::where('status', 'Lopend')->get();
    }
}

