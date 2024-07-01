<?php

namespace App\Http\Controllers;

use App\Models\Device;
use App\Models\User;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    /**
     * Display a listing of the devices.
     */
    public function index()
    {
        $devices = Device::all();
        $users = User::all();
        return view('devices.index', compact('devices', 'users'));
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
            'location' => 'nullable|string|max:255',
        ]);

        $device = Device::findOrFail($id);
        $device->location = $request->input('location');
        $device->save();

        return redirect()->route('devices.index')->with('success', 'Device location updated successfully.');
    }
}
