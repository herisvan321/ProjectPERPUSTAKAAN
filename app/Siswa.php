<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    public $timestamps = false;
    protected $primaryKey= 'id_user';
    public $incrementing = false;
}
