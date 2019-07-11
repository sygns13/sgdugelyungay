<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $fillable = ['nombre','codigo','activo','borrado'];
	protected $guarded = ['id'];
}
