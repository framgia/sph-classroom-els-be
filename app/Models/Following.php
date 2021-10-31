<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Following extends Model
{
    use HasFactory;

    /*
    |--------------------------------------------------------------------------
    | Basic Configuration
    |--------------------------------------------------------------------------
    */

    protected $table = 'following';

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function follower_user()
    {
        $this->belongsTo(User::class, 'follower_id');
    }

    public function followed_user()
    {
        $this->belongsTo(User::class, 'followed_id');
    }

    public function activities()
    {
        return $this->morphMany(Activity::class, 'subjectable');
    }
}
