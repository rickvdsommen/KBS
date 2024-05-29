<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'school',
        'degree',
        'currentYear',
        'degreeYears',
        'description',
        'graduated',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
