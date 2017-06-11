<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Cache;

class User extends Authenticatable
{
    // TODO: Set online indication for the user.
    // TODO: Implement ban system.

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'email', 'password', 'twitter_id', 'facebook_id'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * Online/offline status indicator.
     *
     * @return mixed
     */
    public function isOnline()
    {
        return Cache::has('user-is-online-' . $this->id);
    }

    /**
     * Get the organizations for the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function organizations()
    {
        return $this->belongsToMany(Organization::class)->withTimestamps();
    }
}
