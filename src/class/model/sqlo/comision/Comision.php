<?php

require_once("class/model/sqlo/comision/Main.php");

//***** implementacion de Sqlo para una determinada tabla *****
class ComisionSqlo extends ComisionSqloMain{

  public function insert(array $row) {
    $r = $this->sql->initializeInsert($row);

    $rowD = Dba::get("division", $row["division"]);
    $rowsCH = Dba::all("carga_horaria", [["anio", "=", $row["anio"]], ["semestre", "=", $row["semestre"]], ["plan", "=", $rowD["plan"]]]);

    if(!count($rowsCH)) throw new Exception("No existen cargas horarias asociadas");

    $r_ = $this->sql->format($r);
    $sql = $this->_insert($r_);

    $cursoSqlo = new CursoSqlo();

    $detail = [$this->entity->getName().$r["id"]];
    
    foreach($rowsCH as $rowCh) {
      $data = array(
        "comision" => $r["id"],
        "carga_horaria" => $rowCh["id"]
      );
      $insertCurso = $cursoSqlo->insert($data);
      $sql .= $insertCurso["sql"];
      array_merge($detail, $insertCurso["detail"]);
    }
    
    return array("id" => $r["id"], "sql" => $sql, "detail"=>$detail);
  }


  public function cantidadAlumnosActivos($fecha){
     $sql = EntitySqlo::getInstanceFromString("nomina2")->activos($fecha);

     return "
SELECT com.id AS comision, count(*) AS cantidad
FROM comision AS com
LEFT JOIN nomina2 AS noa ON (noa.comision = com.id)
WHERE fecha = '{$fecha}'
AND noa.id IN(
  SELECT id FROM (
    {$sql}
  ) AS sub
)
GROUP BY comision
  ";
  }

  public function cantidadAlumnosActivosPorTramo($fecha){
     $sql = EntitySqlo::getInstanceFromString("nomina2")->activos($fecha);

     return "
SELECT com.anio AS anio, com.semestre AS semestre, count(*) AS cantidad
FROM comision AS com
LEFT JOIN nomina2 AS noa ON (noa.comision = com.id)
WHERE fecha = '{$fecha}'
AND noa.id IN(
  SELECT id FROM (
    {$sql}
  ) AS sub
)
GROUP BY anio, semestre
ORDER BY anio, semestre
";
  }


  public function cantidadAlumnosNoActivos($fecha){
     $sql = EntitySqlo::getInstanceFromString("nomina2")->noActivos($fecha);

     return "
SELECT com.id AS comision, count(*) AS cantidad
FROM comision AS com
LEFT JOIN nomina2 AS noa ON (noa.comision = com.id)
WHERE fecha = '{$fecha}'
AND noa.id IN(
  SELECT id FROM (
    {$sql}
  ) AS sub
)
GROUP BY comision
  ";
  }







  public function idCantidadAlumnosActivosTramo($fechaAnio, $fechaSemestre){
     $sql = Nomina2Sql::getInstance()->nominaActivosTramo($fechaAnio, $fechaSemestre);

     return "
SELECT com.id, count(*) AS cantidad
FROM comision
LEFT JOIN nomina2 ON (nomina2.comision = comision.id)
INNER JOIN ({$sql}) AS activos ON (activos.comision = comision.id)
WHERE fecha_anio = '{$fechaAnio}'
AND fecha_semetre = {$fechaSemestre}
GROUP BY comision
  ";
  }



  public function cantidadAnioSemestreAutorizadasFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes){
    $condicionFiltros = Data::condicionFiltros($fechaAnio, $fechaSemestre, $dependencia, $planes);

    return "
SELECT anio, semestre, COUNT(*) AS cantidad
FROM comision
INNER JOIN division ON (comision.division = division.id)
INNER JOIN sede ON (division.sede = sede.id)
INNER JOIN plan ON ( division.plan = plan.id )
WHERE {$condicionFiltros}
AND comision.autorizada
GROUP BY anio, semestre
ORDER BY anio, semestre;
";
  }


}
