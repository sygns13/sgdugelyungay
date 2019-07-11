<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $fillable = ['tipodoc','doc','apellidos','nombres','genero','telefono','direccion','activo','borrado','email'];
    protected $guarded = ['id'];
}
