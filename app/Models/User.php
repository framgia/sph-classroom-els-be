<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Contracts\Auth\CanResetPassword;
use Overtrue\LaravelFollow\Followable;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, Followable;

    /*
    |--------------------------------------------------------------------------
    | Basic Configuration
    |--------------------------------------------------------------------------
    */

    protected $with = ['user_type'];

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type_id',
        'avatar'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | Relationships
    |--------------------------------------------------------------------------
    */

    public function user_type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function followers()
    {
        return $this->hasMany(Following::class, 'follower_id');
    }

    public function followed_users()
    {
        return $this->hasMany(Following::class, 'followed_id');
    }
    
    public function sendPasswordResetNotification($token)
    {
        $url = 'http://localhost:3003/new-password?token=' . $token;
        $this->notify(new ResetPasswordNotification($url));
    }

    public function quizzes()
    {
        return $this->belongsToMany(Quiz::class, 'quizzes_taken')->withPivot('id', 'score');
    }

    public function scopeSearchAndExcludeLoggedInUserAndAdmins($query, $id, $search)
    {
        return $query->withCount(['followings', 'followers'])
                     ->where('name', 'LIKE', '%' . $search . '%')
                     ->where('id', '!=', $id)
                     ->where('user_type_id', 2);
    }

    public function scopeSearchAndExcludeAdmins($query, $search)
    {
        return $query->withCount(['followings', 'followers'])
                     ->where('name', 'LIKE', '%' . $search . '%')
                     ->where('user_type_id', 2);
    }
}
