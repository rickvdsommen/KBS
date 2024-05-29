<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;


class ProjectController extends Controller
{
    
    public function projects()
    {
        $all = Project::with('tags')->get();
        dd($all);
    }

    public function categories()
    {
        $all = Project::with('categories')->get();
        dd($all);
    }

    public function index(Request $request)
    {
        $query = Project::with(['tags', 'categories']);
        $searchTerm = $request->input('search');
    
        // Search functionality for project attributes
        if ($searchTerm) {
            $query->where(function ($q) use ($searchTerm) {
                $q->where('projectname', 'like', "%$searchTerm%")
                    ->orWhere('description', 'like', "%$searchTerm%")
                    ->orWhere('phaseName', 'like', "%$searchTerm%")
                    ->orWhere('status', 'like', "%$searchTerm%")
                    ->orWhere('startingDate', 'like', "%$searchTerm%")
                    ->orWhere('projectLeader', 'like', "%$searchTerm%")
                    ->orWhere('productOwner', 'like', "%$searchTerm%");
            });
        }
    
        // Search functionality for categories
        if ($searchTerm) {
            $query->orWhereHas('categories', function ($q) use ($searchTerm) {
                $q->where('category', 'like', "%$searchTerm%");
            });
        }
    
        // Search functionality for tags
        if ($searchTerm) {
            $query->orWhereHas('tags', function ($q) use ($searchTerm) {
                $q->where('tag', 'like', "%$searchTerm%");
            });
        }
    
        // Get all projects if there's no search term
        $projects = $query->paginate(6);
    
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all(); // Fetch all users
        return view('projects.create', compact('tags', 'categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'projectname' => 'required|unique:projects',
            'phaseName' => 'required',
            'description' => 'required',
            'status' => 'required',
            'startingDate' => 'required|date',
            'projectLeader' => 'required',
            'productOwner' => 'required',
            'tags' => 'array',
            'categories' => 'array',
        ]);

        $project = Project::create($request->all());

        // Attach tags and categories
        if ($request->has('tags')) {
            $project->tags()->attach($request->tags);
        }
        if ($request->has('categories')) {
            $project->categories()->attach($request->categories);
        }
        // Attach selected users to the project
        if ($request->has('selectedUsers')) {
            $project->users()->attach($request->selectedUsers);
        }
            return redirect()->route('projects.index')->with('success', 'Project created successfully.');
        }

    public function show(Project $project)
    {
        $project->load(['users','tags', 'categories']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project)
    {
        $tags = Tag::all();
        $users = User::all(); // Fetch all users
        $categories = Category::all();
        return view('projects.edit', compact('project', 'tags', 'categories','users'));
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'projectname' => 'required|unique:projects,projectname,' . $project->id,
            'phaseName' => 'required',
            'description' => 'required',
            'status' => 'required',
            'startingDate' => 'required|date',
            'projectLeader' => 'required',
            'productOwner' => 'required',
            'tags' => 'array',
            'categories' => 'array',
        ]);

        $project->update($request->all());

        // Sync tags and categories
        if ($request->has('tags')) {
            $project->tags()->sync($request->tags);
        }
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }
        if ($request->has('selectedUsers')) {
            $project->users()->attach($request->selectedUsers);
        }
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
