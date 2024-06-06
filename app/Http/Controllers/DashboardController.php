<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Device;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the current date
        $today = now()->format('Y-m-d');

        // Query devices where updated_at is today
        $devicesToday = Device::whereDate('updated_at', $today)->get();

        // Filter out devices with status "offline"
        $updatedDevices = $devicesToday->reject(function ($device) {
            return $device->status === 'offline';
        });
         // Get the logged-in user's projects
        $userProjects = Auth::user()->projects;
        return view('dashboard', compact('updatedDevices', 'userProjects'));
    }
    
    
    
    
}
