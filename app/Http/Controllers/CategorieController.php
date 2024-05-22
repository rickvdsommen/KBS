<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;


class CategorieController extends Controller
{
    public function categories()
    {
        $all = Category::with('project')->get();
        dd($all);
    }
    
}
