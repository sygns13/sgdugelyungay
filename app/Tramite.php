<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = ['expediente','fecha','prioridad_id','origen','tipo','unidadorganica','firma','cargo','fechadoc','tipodocumento_id','numero','siglas','formarecepcion_id','rutafile','folios','asunto','clasificacion_id','numdias','formacopia','unidadorganica_id','detalle','usuario','proveidoatencion','estado','activo','borrado','persona_id','user_id'];
    protected $guarded = ['id'];
}
