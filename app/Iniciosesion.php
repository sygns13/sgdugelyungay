<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Iniciosesion extends Model
{
    protected $fillable = ['fecha','hora','recordar','ip','mac','activo','borrado','users_id'];
	protected $guarded = ['id'];
}
