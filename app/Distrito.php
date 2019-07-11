<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distrito extends Model
{
    protected $fillable = ['nombre','codigo','provincia_id','activo','borrado'];
	protected $guarded = ['id'];
}
