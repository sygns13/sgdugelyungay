<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prioridad extends Model
{
    protected $fillable = ['prioridad','activo','borrado'];
    protected $guarded = ['id'];
}
