<?php

namespace App;

use Laravel\Scout\Searchable;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    use Searchable;
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
    
    
    
}
