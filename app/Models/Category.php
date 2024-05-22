<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{


    use HasFactory;
    protected $fillable = [
        'category',
    ];

    public function project()
    {
        // return $this->belongsToMany(Project::class);
        return $this->belongsToMany(Project::class, 'project_categories');
    }

}
