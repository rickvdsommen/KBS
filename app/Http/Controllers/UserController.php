<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%$search%")
                  ->orWhere('email', 'like', "%$search%")
                  ->orWhere('id', 'like', "$search")
                  ->orWhere('function', 'like', "%$search%");
            });
        }

        // Filtering by role
        if ($request->filled('role')) {
            $role = $request->input('role');
            $query->role($role)->get();
        }

        // Paginate the results
        $users = $query->paginate(10);
        return view('users.index', compact('users'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'function' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);
    
        try {
            // Create a new user
            User::create([
                'name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'function' => $validatedData['function'],
                'password' => bcrypt($validatedData['password']),
            ]);
    
            // Redirect back with a success message
            return redirect()->back()->with('status', 'added');
        } catch (\Exception $e) {
            // Handle any errors, for example:
            // Log::error($e->getMessage());
            return redirect()->back()->with('status', 'error')->withErrors(['error' => 'Er is een fout opgetreden bij het toevoegen van de gebruiker. Probeer het opnieuw.']);
        }
    }
    

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $users = User::all();
        $user->load('device.location');
        return view('users.show', compact('users'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $admin = $user->hasRole('admin');
        return view('users.edit', compact('user', 'admin'), );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'function' => 'required|string|max:255',
            'deactivated' => 'nullable|string|in:on',
        ]);

        if($request->admin === "on"){
            $user->assignRole('admin');
        } elseif ($request->admin === null) {
            $user->removeRole('admin');
        }

        if ($request->has('deactivated')) {
            $user->deactivated = $request->input('deactivated') === 'on';
            if ($user->device) {
                $user->device->status = 'deactivated';
                $user->device->save();
            }
        } else {
            $user->deactivated = false; // or null, depending on your application logic
        }

        $user->update($request->except('deactivated'));
        
        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
