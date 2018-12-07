<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['created_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
	
	public function likes(){
	
	return $this->hasMany(Like::class);
    }
    
}
