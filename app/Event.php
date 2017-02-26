<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    //
    protected $fillable = [
        'title', 'desc'
    ];

    /**
     * The attributes that should be hidden for arrays.
     
    protected $hidden = [
        'password', 'remember_token',
    ];
    */
}
