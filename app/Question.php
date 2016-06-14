<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = ['question', 'latitude', 'longitude', 'points', 'answer', 'answered'];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'answered' => 'boolean',
    ];
    
    /**
     * Check if answer is correct.
     *
     * @param $answer
     * @return bool
     */
    public function checkAnswer($answer)
    {
        return $this->answer == $answer;
    }

    /**
     * Returns associated user.
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
