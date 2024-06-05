<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Project;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query()->with('degrees', 'skills', 'courses');
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
                  ->orWhere('function', 'like', '%' . $search . '%')
                  ->orWhereHas('courses', function ($q) use ($search) {
                      $q->where('courseName', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('skills', function ($q) use ($search) {
                      $q->where('skillName', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('degrees', function ($q) use ($search) {
                      $q->where('school', 'like', '%' . $search . '%');
                  })
                  ->orWhereHas('degrees', function ($q) use ($search) {
                    $q->where('degree', 'like', '%' . $search . '%');
                });
            });
        }
        $users = $query->paginate(9); 
        return view('teams.index', compact('users'));
    }

    public function show(User $user)
    {
        $user->load('courses', 'degrees', 'skills'); // Eager load relationships
        return view('teams.show', compact('user'));
    }
}
