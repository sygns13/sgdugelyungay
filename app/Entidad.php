<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Entidad extends Model
{
protected $fillable = ['codigo','nombre','activo','borrado','siglas','abrev','detalle'];
	protected $guarded = ['id'];
}
