<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;

class CourseController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2100',
            'description' => 'required|string|max:255',
        ]);

        Course::create([
            'courseName' => $request->input('name'),
            'year' => $request->input('year'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Cursus toegevoegd!');
    }

    public function destroy(Course $course)
    {
        $course->delete();

        return redirect()->back()->with('success', 'Cursus verwijderd!');
    }
}