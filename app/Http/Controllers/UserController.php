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

    /**
     * Creates temporary signed route for account registration.
     */
    public function store(Request $request)
    {
        $email = $request->email;
        $signedUrl = URL::temporarySignedRoute('register', now()->addDays(7), ['email' => $email]);

        Mail::to($email)->send(new \App\Mail\RegistrationMail($signedUrl));

        return Redirect::route('users.index')->with('status', 'invited');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $users = User::all();
        return view('users.index', compact('users'));
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
            'name' => 'required',
            'birthday' => 'required',
            'function' => 'required',
        ]);

        if($request->admin === "on"){
            $user->assignRole('admin');
        } elseif ($request->admin === null) {
            $user->removeRole('admin');
        }

        $user->update($request->all());
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
