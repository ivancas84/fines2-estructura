<?php

require_once("class/model/sqlo/curso/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class CursoSqlo extends CursoSqloMain{


  public function idCursosNoDisponibles($fecha){
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesAutorizadasPublicadas($fecha, "com");

    return "SELECT DISTINCT
{$this->sql->fieldId()}
{$this->sql->from()}
{$this->sql->join()}
{$this->sql->joinToma()}
WHERE (toma.estado = 'Aprobada' OR toma.estado = 'Pendiente' OR toma.estado = 'Temporal')
AND toma.estado_contralor != 'Modificar'
AND {$this->sql->conditionAdvanced($advanced)}
";
  }

  public function idCursosRenuncias($fecha){
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesAutorizadasPublicadas($fecha, "com");

    return "SELECT DISTINCT
{$this->sql->fieldId()}
{$this->sql->from()}
{$this->sql->join()}
{$this->sql->joinToma()}
WHERE (toma.estado = 'Renuncia')
AND toma.estado_contralor != 'Modificar'
AND {$this->sql->conditionAdvanced($advanced)}
";
  }

  public function idCursosDisponibles($fecha){
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesAutorizadasPublicadas($fecha, "com");

    return "SELECT DISTINCT
  {$this->sql->fieldId()}
  {$this->sql->from()}
  {$this->sql->join()}
  {$this->sql->joinToma()}
  WHERE (toma.estado = 'Observada' OR toma.estado = 'Renuncia' OR toma.estado = 'Error'  OR toma.estado IS NULL)
  AND {$this->sql->conditionAdvanced($advanced)}
";
  }

  public function actoPublicoSinCubrir($fecha){
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesAutorizadasPublicadas($fecha, "com");
    $sql = "SELECT DISTINCT
{$this->sql->fieldsFull()}
{$this->sql->from()}
{$this->sql->join()}
WHERE

{$this->sql->conditionAdvanced($advanced)}

AND curs.id NOT IN (
  {$this->idCursosNoDisponibles($fecha)}
)
AND curs.id IN (
  {$this->idCursosDisponibles($fecha)}
)
" . $this->sql->orderBy([
  "ch_asi_nombre" => "asc",
  "com_dvi_sed_numero" => "asc",
  "com_dvi_sed_numero" => "asc",
  "com_anio" => "asc",
  "com_semestre" => "asc",
]) . "
";


return $sql;

  }


  public function actoPublicoRenuncias($fecha){
    $advanced = EntitySql::getInstanceString("comision")->_advancedComisionesAutorizadasPublicadas($fecha, "com");

    return "SELECT DISTINCT
{$this->sql->fieldsFull()},
{$this->sql->from()}
{$this->sql->join()}
WHERE {$this->sql->conditionAdvanced($advanced)}
AND curs.id NOT IN (
  {$this->idCursosNoDisponibles($fecha)}
)
AND curs.id IN (
  {$this->idCursosRenuncias($fecha)}
)
" . $this->sql->orderBy([
  "ch_asi_nombre" => "asc",
  "com_dvi_sed_numero" => "asc",
  "com_dvi_sed_numero" => "asc",
  "com_anio" => "asc",
  "com_semestre" => "asc",
]) . "
";

  }



}
