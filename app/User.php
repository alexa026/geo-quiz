<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Increase user points by specific amount.
     *
     * @param $amount
     */
    public function increasePoints($amount)
    {
        $this->points += $amount;
        $this->save();
    }

    /**
     * Decrease points by specific amount.
     *
     * @param $amount
     */
    public function decreasePoints($amount)
    {
        $this->points -= $amount;
        $this->save();
    }

    /**
     * Check if 2 users are friends.
     * 
     * @param $id
     * @return mixed
     */
    public function isFriendWith($id)
    {
        return $this->friends->contains($id);
    }

    /**
     * Returns questions associated with user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function questions()
    {
        return $this->hasMany('App\Question');
    }

    /**
     * Returns user's friends list.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function friends()
    {
        return $this->belongsToMany('App\User', 'friends_list', 'user1_id', 'user2_id');
    }
}
