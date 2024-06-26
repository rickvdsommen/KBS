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
        $query = Project::with(['tags', 'categories', 'productOwnerRelation', 'projectLeaderRelation']);
        $searchTerm = $request->input('search');
    
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
    
        if ($searchTerm) {
            $query->orWhereHas('categories', function ($q) use ($searchTerm) {
                $q->where('category', 'like', "%$searchTerm%");
            });
        }
    
        if ($searchTerm) {
            $query->orWhereHas('tags', function ($q) use ($searchTerm) {
                $q->where('tag', 'like', "%$searchTerm%");
            });
        }
    
        $projects = $query->paginate(4);
    
        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();
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

        if ($request->has('tags')) {
            $project->tags()->attach($request->tags);
        }
        if ($request->has('categories')) {
            $project->categories()->attach($request->categories);
        }
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

    public function edit(Project $project, Request $request)
    {
        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();

        $searchTermUser = $request->input('userSearch');
        if ($searchTermUser) {
            $filteredUsersWorkingWith = User::where('name', 'like', "%$searchTermUser%")->get();
        } else {
            $filteredUsersWorkingWith = $users;
        }

        $searchTermPO = $request->input('productOwnerSearch');
        if ($searchTermPO) {
            $filteredUsersPO = User::where('name', 'like', "%$searchTermPO%")->get();
        } else {
            $filteredUsersPO = $users;
        }

        $searchTermPL = $request->input('projectLeaderSearch');
        if ($searchTermPL) {
            $filteredUsersPL = User::where('name', 'like', "%$searchTermPL%")->get();
        } else {
            $filteredUsersPL = $users;
        }

        return view('projects.edit', compact('project', 'tags', 'categories', 'filteredUsersWorkingWith', 'filteredUsersPO', 'filteredUsersPL'));
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

        if ($request->has('tags')) {
            $project->tags()->sync($request->tags);
        }
        if ($request->has('categories')) {
            $project->categories()->sync($request->categories);
        }
        if ($request->has('selectedUsers')) {
            $project->users()->sync($request->selectedUsers);
        }
        return redirect()->route('projects.index')->with('success', 'Project updated successfully.');
    }

    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
