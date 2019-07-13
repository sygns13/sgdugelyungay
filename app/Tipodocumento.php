<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tipodocumento extends Model
{
    protected $fillable = ['tipo','activo','borrado'];
    protected $guarded = ['id'];
}
