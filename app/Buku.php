<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    public $timestamps = false;
    protected $primaryKey= 'kd_buku';
    public $incrementing = false;
}
