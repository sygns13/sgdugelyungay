<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Representantelegal extends Model
{
    protected $fillable = ['nombre','cargo','activo','borrado','entidad_id'];
    protected $guarded = ['id'];
}
