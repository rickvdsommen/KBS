<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Skill;

class SkillController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'skill' => 'required|string|max:255',
            'experience' => 'required|integer|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        // Create a new skill
        Skill::create([
            'skillName' => $request->input('skill'),
            'skillExperience' => $request->input('experience'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),  // Ensure the user is authenticated and their ID is stored
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Vaardigheid toegevoegd!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Skill $skill)
    {
        $skill->delete();

        return redirect()->back()->with('success', 'Skill deleted successfully!');
    }
}
