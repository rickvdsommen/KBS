<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class course extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'courseName',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
