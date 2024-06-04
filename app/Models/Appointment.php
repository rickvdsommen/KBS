<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'start',
        'end',
        'title',
        'all_day',
        // 'personalStatus',
        // 'description',
        // 'location',
        // 'user_id',
    ];
 
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
