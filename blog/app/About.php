<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = ['created_at'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
