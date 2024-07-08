<?php

namespace App\Http\Controllers;

use App\Models\Availability;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AvailabilityController extends Controller
{
    /**
     * Display a listing of the availabilities.
     */
    public function index(Request $request)
    {
        // Query availabilities with optional filters
        $availabilityQuery = Availability::query();

        // Apply filters based on search parameters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $availabilityQuery->whereHas('user', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                      ->orWhere('device_id', 'like', "%$search%");
            })->orWhereHas('location', function ($query) use ($search) {
                $query->where('name', 'like', "%$search%");
            });
        }

        // Fetch availabilities with associated user and location
        $availabilities = $availabilityQuery->with('user', 'location')->paginate(10);
        $users = User::all();
        $locations = Location::all();



        return view('availability.index', compact('availabilities', 'users', 'locations'));
    }

    
    /**
     * Link a availability to a user.
     */
    public function link(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:availabilities,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $availability = Availability::findOrFail($request->input('id'));
        $availability->user_id = $request->input('user_id');
        $availability->save();

        return redirect()->route('availability.index')->with('success', 'availability linked successfully.');
    }

    /**
     * Unlink a availability from a user.
     */
    public function unlink(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:availabilities,id',
        ]);

        $availability = Availability::findOrFail($request->input('id'));
        $availability->user_id = null;
        $availability->save();

        return redirect()->route('availability.index')->with('success', 'availability unlinked successfully.');
    }

    public function update(Request $request, availability $availability)
    {
        // Validate the request
        $request->validate([
            'location_id' => 'nullable|exists:locations,id',
        ]);

        // Update availability location_id
        $availability->location_id = $request->input('location_id');
        $availability->save();

        return redirect()->back()->with('success', 'availability location updated successfully.');
    }

    public function updateAvailability(Request $request)
    {
        $user = Auth::user();

        $user->availability->updated_at = now();
        $user->availability->status = $request->availability;
        
        $user->availability->save();
        return redirect()->back()->with('success', 'Availability updated successfully.');
    }
}
