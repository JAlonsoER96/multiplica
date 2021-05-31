<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    public $table = 'colores';
    protected $primaryKey = 'id';
    protected $fillable = ['id','name','color','pantone','year'];
    public $timestamps = false;
}
