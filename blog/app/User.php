<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Http\Request;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nick', 'name', 'email', 'password', 'phone',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function posts(){
        
        return $this->hasMany(Post::class);
    }
    
    public function likes(){
        
        return $this->hasMany(Like::class);
    }

    public function messages()
    {
        return $this->belongsTo(Message::class);
    }

    public function rooms()
    {
        return $this->belongsToMany(Room::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
