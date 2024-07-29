<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class Agenda extends Component
{
    public $appointments;

    public function render()
    {
        return view('livewire.agenda');
    }

    public function mount()
    {
        $this->refreshItems();
    }

    public function refreshItems()
    {
        $this->appointments = Appointment::whereDate('start', Carbon::today())
            ->get();
    }
}
