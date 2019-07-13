<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Detalletramite extends Model
{
    protected $fillable = ['estado','detalleestado','observacion','fechadetalle','activo','borrado','tramite_id','user_id'];
    protected $guarded = ['id'];
}
