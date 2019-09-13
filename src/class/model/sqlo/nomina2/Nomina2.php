<?php

require_once("class/model/sqlo/nomina2/Main.php");

class Nomina2Sqlo extends Nomina2SqloMain{

  public function repetidosPeriodoAll($fechaAnio, $fechaSemestre, $render = null) { //id de nominas correspondienetes a alumnos repetidos
    $r = $this->render($render);
    $r->addAdvanced([
      ["com_fecha_anio", "=", $fechaAnio],
      ["com_fecha_semestre", "=", $fechaSemestre],
      ["com_autorizada","=",true],
      ["activo","=",true]
    ]);
    $sql1 = $this->all($r);
    $sql2 = IdPersonaSqlo::getInstance()->alumnosRepetidosPeriodo($fechaAnio, $fechaSemestre);

    return "SELECT nomina.*
  FROM (
  {$sql1}
  ) AS nomina
  WHERE nomina.persona IN(
    SELECT id FROM (
      {$sql2}
    ) AS repetidos
  )
  ";

  }



















































  public function personasActivasRepetidasPeriodo($periodo){ //id de la persona activa y cantidad de duplicados
    return "SELECT persona, COUNT(*) as cantidad
FROM nomina2
INNER JOIN comision ON (nomina2.comision = comision.id)
WHERE nomina2.activo
AND comision.fecha_anio = '" . $periodo["fecha_anio"] . "'
AND comision.fecha_semestre = " . $periodo["fecha_semestre"] . "
GROUP BY persona
HAVING cantidad > 1
";
  }





  public function idsActivosFiltros($filtros) { //id de nomina solo de alumnos activos
    //$condicionFiltros = Data::condicionFiltros($filtros);
    $render = new Render();
    $render->setCondition([
      ["com_fecha_anio","=",$filtros["fecha_anio"]],
      ["com_fecha_semestre","=",$filtros["fecha_semestre"]],
      ["com_autorizada","=",$filtros["autorizada"]],
      ["com_dvi__clasificacion","=",$filtros["clasificacion"]],
      ["com_dvi_sed_dependencia","=", $filtros["dependencia"]],
      ["activo","=", true],
    ]);
    $sql = $this->all($render);
    $sql2 = $this->personasActivasRepetidasPeriodo($filtros);
    
    return "SELECT nomina2.id
FROM (
  {$sql}
) AS nomina2
WHERE nomina2.persona NOT IN (
  SELECT persona FROM ({$sql2}) AS repetidos
)";

    return "SELECT nomina2.id
FROM nomina2
INNER JOIN comision ON (nomina2.comision = comision.id)
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
WHERE ({$condicionFiltros})
AND nomina2.activo
AND nomina2.persona NOT IN (
  SELECT persona FROM ({$sql}) AS repetidos
)
";
  }

}
