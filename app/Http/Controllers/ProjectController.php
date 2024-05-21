<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;

class ProjectController extends Controller
{
    //
    public function projects()
    {
        $all = Project::with('tags')->get();
        dd($all);
    }
    //
    public function categories()
    {
        $all = Project::with('categories')->get();
        dd($all);
    }
}
