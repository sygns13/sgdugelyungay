<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tramite extends Model
{
    protected $fillable = ['expediente','fecha','prioridad_id','origen','entidad_id','fechadoc','tipodocumento_id','numero','siglas','formarecepcion_id','rutafile','folios','asunto','clasificacion_id','formacopia','unidadorganica_id','detalledestino','estado','activo','borrado','persona_id','user_id','entidad','detalle','firma','cargo','clasificacion','dias','unidadorganica'];
    protected $guarded = ['id'];
}
