<?php

require_once("class/model/sqlo/coordinador/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class CoordinadorSqlo extends CoordinadorSqloMain{


  public function deleteAll(array $ids) { //@override
    if(empty($ids)) throw new Exception("No existen identificadores definidos");
    $ids_ = $this->sql->formatIds($ids);
    $baja = date('Y-m-d H:i:s');
    $sql = "
UPDATE " . $this->entity->sn_() . " SET baja = '{$baja}'
WHERE {$this->entity->getPk()->getName()} IN ({$ids_});
";

    $detail = $ids;
    array_walk($detail, function(&$item) { $item = $this->entity->getName().$item; });
    return ["ids"=>$ids, "sql"=>$sql, "detail"=>$detail];
  }

  public function cantidadAlumnos($fecha){
    /**
     * Metodo obsoleto, sera reemplazado por cantidadAlumnosTramo_($anio, $semestre)
     */
     $sqlActivos = EntitySqlo::getInstanceString("comision")->cantidadAlumnosActivos($fecha);
     $sqlNoActivos = EntitySqlo::getInstanceString("comision")->cantidadAlumnosNoActivos($fecha);

     return "
SELECT coor.persona, SUM(cantidad_activos.cantidad) AS cantidad_activos, SUM(cantidad_no_activos.cantidad) AS cantidad_no_activos
FROM coordinador AS coor
INNER JOIN sede ON (coor.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
LEFT JOIN ({$sqlActivos}) AS cantidad_activos ON (cantidad_activos.comision = comision.id)
LEFT JOIN ({$sqlNoActivos}) AS cantidad_no_activos ON (cantidad_no_activos.comision = comision.id)
WHERE coor.baja IS NULL
GROUP BY persona

";
  }

  public function cantidadComisiones($fecha){
    /**
     * Metodo obsoleto, sera reemplazado por cantidadComisionesTramo_($anio, $semestre)
     */
    return "
SELECT coor.persona, COUNT(comision.id) AS cantidad_comisiones
FROM coordinador AS coor
INNER JOIN sede ON (coor.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE coor.baja IS NULL
AND comision.fecha = '$fecha'
AND comision.autorizada
AND comision.publicar
AND division.plan != 3
GROUP BY persona

";
 }

   public function cantidadComisionesTramo($fecha){
     /**
      * Metodo obsoleto, sera reemplazado por cantidadComisionesTramo_($anio, $semestre)
      */
    return "
SELECT coor.persona, comision.anio, comision.semestre, COUNT(comision.id) AS cantidad_comisiones
FROM coordinador AS coor
INNER JOIN sede ON (coor.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE coor.baja IS NULL
AND comision.fecha = '$fecha'
AND comision.autorizada
AND comision.publicar
AND division.plan != 3
GROUP BY persona, comision.anio, comision.semestre

";
  }







  public function cantidadComisionesTramo_($fechaAnio, $fechaSemestre){
    /**
     * Metodo obsoleto, sera reemplazado por cantidadComisionesTramo_($anio, $semestre)
     */
   return "
SELECT coor.persona, comision.anio, comision.semestre, COUNT(comision.id) AS cantidad_comisiones
FROM coordinador AS coor
INNER JOIN sede ON (coor.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
WHERE coor.baja IS NULL
AND comision.fecha_anio = '$fechaAnio'
AND comision.fecha_semestre = $fechaSemestre
AND comision.autorizada
AND comision.publicar
AND division.plan != 3
GROUP BY persona, comision.anio, comision.semestre

";
 }





 public function cantidadAlumnosTramo($fechaAnio, $fechaSemestre){
    $sql1 = ComisionSqlo::getInstance()->idCantidadAlumnosActivosTramo($fechaAnio, $fechaSemestre);
    $sql2 = ComisionSqlo::getInstance()->cantidadAlumnosNoActivosTramo($fechaAnio, $fechaSemestre);

    return "
SELECT coor.persona, SUM(cantidad_activos.cantidad) AS cantidad_activos, SUM(cantidad_no_activos.cantidad) AS cantidad_no_activos
FROM coordinador AS coor
INNER JOIN sede ON (coor.sede = sede.id)
INNER JOIN division ON (division.sede = sede.id)
INNER JOIN comision ON (comision.division = division.id)
LEFT JOIN ({$sql1}) AS cantidad_activos ON (cantidad_activos.comision = comision.id)
LEFT JOIN ({$sql2}) AS cantidad_no_activos ON (cantidad_no_activos.comision = comision.id)
WHERE coor.baja IS NULL
GROUP BY persona
";
 }




}
