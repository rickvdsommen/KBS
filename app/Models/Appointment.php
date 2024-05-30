<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'finish_time',
        'title',
        'personalStatus',
        'description',
        'location',
        'user_id',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
