<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'projectname',
        'phaseName',
        'description',
        'status',
        'startingDate',
        'projectLeader',
        'categorie',
        'productOwner',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'project_tags');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'project_categories');
    }
    public function users()
    {
        return $this->belongsToMany(User::class, 'user_project');
    }
}
