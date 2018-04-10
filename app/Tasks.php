<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $fillable = array('id', 'name', 'finished', 'deleted');
}
