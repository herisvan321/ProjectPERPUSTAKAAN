<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Penerbit extends Model
{
    public $timestamps = false;
    protected $primaryKey= 'kd_penerbit';
    public $incrementing = false;
}
