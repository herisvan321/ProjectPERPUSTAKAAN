<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    public $timestamps = false;
    protected $primaryKey= 'kd_kategori';
    public $incrementing = false;
}
