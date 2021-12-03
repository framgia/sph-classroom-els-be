<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    protected $fillable = [
        'subject', 'log_name', 'description', 'subject', 'user_id', 'properties'
    ];
        /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

    // public function subjectable()
    // {
    //     return $this->morphTo();
    // }
}
