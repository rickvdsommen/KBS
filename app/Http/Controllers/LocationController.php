<?php

namespace App\Http\Controllers;

use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    
    /**
     * Show the form for creating a new location.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');
        
        // Query locations based on search term
        $locationsQuery = Location::query();
    
        if ($search) {
            $locationsQuery->where('name', 'LIKE', '%' . $search . '%');
        }
    
        $locations = $locationsQuery->paginate(10); // Fetch locations with pagination
    
        return view('locations.index', compact('locations'));
    }
    

    /**
     * Store a newly created location in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            // Add other validation rules as needed
        ]);

        Location::create([
            'name' => $request->name,
            // Add other fields as needed
        ]);

        return redirect()->route('locations.index')->with('success', 'Location created successfully.');
    }

    /**
     * Remove the specified location from storage.
     */
    public function destroy(Location $location)
    {
        $location->delete();

        return redirect()->route('locations.index')->with('success', 'Location deleted successfully.');
    }
}
