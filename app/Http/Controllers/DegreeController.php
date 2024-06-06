<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Degree;

class DegreeController extends Controller
{
    public function store(Request $request)
    {
        // dd($request);
        $request->validate([
            'degree' => 'required|string|max:255',
            'school' => 'required|string|max:255',
            'degreeYears' => 'required|integer|min:1',
            'currentYear' => 'integer|min:1',
            'description' => 'nullable|string|max:255',
        ]);

        Degree::create([
            'degree' => $request->input('degree'),
            'school' => $request->input('school'),
            'degreeYears' => $request->input('degreeYears'),
            'currentYear' => $request->input('currentYear'),
            'description' => $request->input('description'),
            'graduated' => $request->has('graduated') ? true : false,
            'user_id' => auth()->id(),
        ]);

        return redirect()->back()->with('success', 'Degree added successfully!');
    }

    public function destroy(Degree $degree)
    {
        $degree->delete();

        return redirect()->back()->with('success', 'Degree deleted successfully!');
    }
}
