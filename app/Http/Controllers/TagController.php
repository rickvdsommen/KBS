<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    
    public function index()
    {
        $tags = Tag::all();
        return view('tags.index', compact('tags'));
    }

}
