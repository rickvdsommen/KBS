<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Tag;
use App\Models\Category;
use App\Models\User;

class ProjectController extends Controller
{
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
        $users = User::where('deactivated', false)->get(); // Fetch all active users
        $filteredUsersPL = $users; // Assuming all active users initially
        $filteredUsersPO = $users; // Assuming all active users initially
    
        return view('projects.create', compact('tags', 'categories', 'users', 'filteredUsersPL', 'filteredUsersPO'));
    
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
            'progress' => 'integer|min:0|max:100',
            'tags' => 'array',
            'profile_picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
            'categories' => 'array',
        ]);

        $project = Project::create($request->all());

        if ($request->hasFile('picture')) {
            $imageName = time().'.'.$request->picture->extension();
            $request->picture->move(public_path('images'), $imageName);
            $project->picture = $imageName; // Updated this line
        }

        if ($request->has('tags')) {
            $project->tags()->attach($request->tags);
        }
        if ($request->has('categories')) {
            $project->categories()->attach($request->categories);
        }
        if ($request->has('selectedUsers')) {
            $project->users()->attach($request->selectedUsers);
        }

        $project->save();

        return view('projects.show', compact('project'))->with('success', 'Project created successfully.');
    }

    public function show(Project $project)
    {
        $project->load(['users','tags', 'categories']);
        return view('projects.show', compact('project'));
    }

    public function edit(Project $project, Request $request)
    {
        $currentUser = auth()->user();
        $projectLeaderId = (int) $project->projectLeader;
        $productOwnerId = (int) $project->productOwner;

        if ($currentUser->id !== $projectLeaderId && $currentUser->id !== $productOwnerId && !$currentUser->hasRole('admin')) {
            return redirect()->route('projects.show', $project)->with('error', 'You do not have permission to edit this project.');
        }

        $tags = Tag::all();
        $categories = Category::all();
        $users = User::all();

        $searchTermUser = $request->input('userSearch');
        if ($searchTermUser) {
            $filteredUsersWorkingWith = User::where('name', 'like', "%$searchTermUser%")->get();
        } else {
            $filteredUsersWorkingWith = $users;
        }

        // Filter and fetch only active users for Project Leader dropdown
        $searchTermPL = $request->input('projectLeaderSearch');
        if ($searchTermPL) {
            $filteredUsersPL = User::where('name', 'like', "%$searchTermPL%")->where('deactivated', false)->get();
        } else {
            $filteredUsersPL = User::where('deactivated', false)->get();
        }

        // Filter and fetch only active users for Product Owner dropdown
        $searchTermPO = $request->input('productOwnerSearch');
        if ($searchTermPO) {
            $filteredUsersPO = User::where('name', 'like', "%$searchTermPO%")->where('deactivated', false)->get();
        } else {
            $filteredUsersPO = User::where('deactivated', false)->get();
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
        'progress' => 'required|integer|min:1|max:100',
        'picture' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        'tags' => 'array',
        'categories' => 'array',
        'selectedUsers' => 'array',
    ]);

    $data = $request->except('picture');

    if ($request->hasFile('picture')) {
        // Delete the old image if it exists
        if ($project->picture && file_exists(public_path('images/' . $project->picture))) {
            unlink(public_path('images/' . $project->picture));
        }

        // Store the new image
        $imageName = time() . '.' . $request->picture->extension();
        $request->picture->move(public_path('images'), $imageName);
        $data['picture'] = $imageName;
    }

    $project->update($data);

    // Sync tags, categories, and selectedUsers if they are present in the request
    if ($request->has('tags')) {
        $project->tags()->sync($request->tags);
    }
    if ($request->has('categories')) {
        $project->categories()->sync($request->categories);
    }
    if ($request->has('selectedUsers')) {
        $project->users()->sync($request->selectedUsers);
    }


    return view('projects.show', compact('project'))->with('success', 'roject updated successfully.');
}


    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index')->with('success', 'Project deleted successfully.');
    }
}
