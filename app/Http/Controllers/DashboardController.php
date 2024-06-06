<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Device;
use Illuminate\Support\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $users = User::with('device')
        ->whereHas('device', function($query) {
            $query->whereDate('updated_at', Carbon::today())
              ->whereIn('status', ['aanwezig', 'bezet']);
        })->get();
        
         // Get the logged-in user's projects
        $userProjects = Auth::user()->projects;

        return view('dashboard', compact('userProjects', 'users'));
    }
    
    
    
    
}
