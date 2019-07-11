<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provincias extends Model
{
    protected $fillable = ['nombre','codigo','departamento_id','activo','borrado','distritojudicial_id'];
	protected $guarded = ['id'];
}
