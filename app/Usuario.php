<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    public $table = 'usuarios';

    protected $primaryKey = 'id';
    protected $fillable = ['id','name','email','password','tipo'];

    public $timestamps = false;
}
