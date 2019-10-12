<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Action extends Model
{
    public $timestamps = false;
    protected $primaryKey= 'kd_act';
    public $incrementing = false;
}
