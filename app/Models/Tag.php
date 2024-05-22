<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'tag',
    ];

    public function projects()
    {
        // return $this->belongsToMany(Project::class);
        return $this->belongsToMany(Project::class, 'project_tags');
    }
}
