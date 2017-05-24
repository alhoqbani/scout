<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Film extends Model
{
    use Searchable;
    protected $table = 'film';
    protected $primaryKey = 'film_id';
    public $timestamps = false;
    
    public function actors()
    {
        return $this->belongsToMany(Actor::class, 'film_actor', 'film_id', 'actor_id');
    }
}
