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
    public function index()
    {
        $users = User::all();
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
        return view('users.edit', compact('user'));
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
