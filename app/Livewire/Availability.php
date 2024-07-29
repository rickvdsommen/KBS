<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Carbon;
use App\Models\User;

class Availability extends Component
{
    public $users;

    public function render()
    {
        return view('livewire.availability');
    }

    public function mount()
    {
        $this->refreshItems();
    }

    public function refreshItems()
    {
        $this->users = User::with('availability')
            ->whereHas('availability', function($query) {
                $query->whereDate('updated_at', Carbon::today())
                    ->whereIn('status', ['aanwezig', 'bezet']);
            })
            ->get();
    }
}
