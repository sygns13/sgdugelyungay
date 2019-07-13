<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['nombres','apellidos','dni','genero','direccion','imagen','activo','borrado'];
    protected $guarded = ['id'];
}
