<?php

// DashboardController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Device;
use App\Models\Appointment;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        try {
            // Fetch users with today's status updates
            $users = User::with('device')
                ->whereHas('device', function($query) {
                    $query->whereDate('updated_at', Carbon::today())
                        ->whereIn('status', ['aanwezig', 'bezet']);
                })
                ->get();
    
            // Get the logged-in user's projects
            $userProjects = Auth::user()->projects;
    
            // Fetch today's agenda
            $appointments = Appointment::whereDate('start', Carbon::today())
                ->get();
    
            return view('dashboard', compact('userProjects', 'users', 'appointments'));
        } catch (\Exception $e) {
            // Log the error or handle it appropriately
            return back()->withError('Failed to load dashboard data.');
        }
    }
}    

