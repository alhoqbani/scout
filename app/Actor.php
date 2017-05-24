<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Actor extends Model
{
    use Searchable;
    protected $table = 'actor';
    protected $primaryKey = 'actor_id';
    public $timestamps = false;
    
    
}
