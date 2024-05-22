<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;

class TagController extends Controller
{
    //
    public function tags()
    {
        $all = Tag::with('projects')->get();
        dd($all);
    }
}
