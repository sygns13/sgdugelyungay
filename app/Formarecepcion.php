<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Formarecepcion extends Model
{
    protected $fillable = ['forma','activo','borrado'];
    protected $guarded = ['id'];
}
