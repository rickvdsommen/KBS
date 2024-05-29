<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    
    public function index(Request $request)
    {
        $tags = Tag::all();
        $search = $request->query('search');
    // Start building the query
    $query = Tag::query();
    
    // Retrieve search query from request
    $search = $request->query('search');
    
    // Retrieve all tags or filter by search query
    if ($search !== null) {
        $query->where('tag', 'like', '%' . $search . '%');
    }
    
    // Paginate the results
    $tags = $query->paginate(5); // Adjust the pagination as needed

    return view('tags.index', compact('tags'));
    }

    public function create()
    {
        return view('tag.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tag' => 'required|string|max:255|unique:tags',
        ]);

        Tag::create($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag created successfully');
    }

    public function edit(Tag $tag)
    {
        return view('tags.edit', compact('tag'));
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'tag' => 'required|string|max:255|unique:tags,tag,' . $tag->id,
        ]);

        $tag->update($request->all());
        return redirect()->route('tags.index')->with('success', 'Tag updated successfully');
    }

    public function destroy(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('tags.index')->with('success', 'Tag deleted successfully');
    }
}
