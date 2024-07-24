<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Availability;
use App\Models\Appointment;
use App\Models\Project;
use Illuminate\Support\Carbon;

class Poi extends Component
{
    protected $layout = null;
    public function render()
    {
        try {
            $users = User::with('availability')
                ->whereHas('availability', function($query) {
                    $query->whereDate('updated_at', Carbon::today())
                        ->whereIn('status', ['aanwezig', 'bezet']);
                })
                ->get();

            $projects = Project::where('status', 'Lopend')->get();

            $appointments = Appointment::whereDate('start', Carbon::today())
                ->get();

            return view('livewire.poi', compact('projects', 'users', 'appointments'));
        } catch (\Exception $e) {
            return back()->withError('Failed to load dashboard data.');
        }
    }
}
