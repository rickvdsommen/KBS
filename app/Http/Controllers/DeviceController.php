<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use App\Models\Location;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     */
    public function index(Request $request)
    {
        $name = $request->input('name');
        $id = $request->input('id');

        // Query devices with optional filters
        $devicesQuery = Device::query();

        // Apply filters based on search parameters
        if (!empty($name)) {
            $devicesQuery->whereHas('user', function ($query) use ($name) {
                $query->where('name', 'like', '%' . $name . '%');
            });
        }

        if (!empty($id)) {
            $devicesQuery->where('id', $id);
        }

        // Fetch devices with associated user and location
        $devices = $devicesQuery->with('user', 'location')->paginate(10)();
        $users = User::all();
        $locations = Location::all();



        return view('devices.index', compact('devices', 'users', 'locations'));
    }

    
    /**
     * Link a device to a user.
     */
    public function link(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $device = Device::findOrFail($request->input('device_id'));
        $device->user_id = $request->input('user_id');
        $device->save();

        return redirect()->route('devices.index')->with('success', 'Device linked successfully.');
    }

    /**
     * Unlink a device from a user.
     */
    public function unlink(Request $request)
    {
        $request->validate([
            'device_id' => 'required|exists:devices,id',
        ]);

        $device = Device::findOrFail($request->input('device_id'));
        $device->user_id = null;
        $device->save();

        return redirect()->route('devices.index')->with('success', 'Device unlinked successfully.');
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'location_id' => 'nullable|exists:locations,id',
        ]);

        $device = Device::findOrFail($id);
        $device->location_id = $request->input('location_id');
        $device->save();

        return redirect()->route('devices.index')->with('success', 'Device location updated successfully.');
    }
}
