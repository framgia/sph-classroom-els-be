<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Basic Configuration
    |--------------------------------------------------------------------------
    */

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'description',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user()
    {
        $this->belongsTo(User::class);
    }

    public function subjectable()
    {
        return $this->morphTo();
    }
}
