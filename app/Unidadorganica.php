<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadorganica extends Model
{
    protected $fillable = ['codigo','siglas','nombre','activo','borrado','abreviatura'];
    protected $guarded = ['id'];
}
