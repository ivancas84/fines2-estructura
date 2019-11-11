<?php

/**
 * @todo Implementar render en el getall
 */
require_once("../src/config/config.php");
require_once("class/tools/Filter.php");
require_once("class/controller/Dba.php");
require_once("class/model/Data.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");


$id_curso = $_GET["id"];

$render = new Render();
$tomas =  Dba::fetchAll("
SELECT toma.id, toma.curso, curso.comision, curso.carga_horaria, curso.estado 
FROM toma 
INNER JOIN curso ON (toma.curso = curso.id)
WHERE curso = {$id_curso}");
echo "<pre>";
for($i = 1; $i < count($tomas); $i++){
  $idToma = $tomas[$i]["id"];
  $id = Dba::uniqId();
  $comision = $tomas[$i]["comision"];
  $cargaHoraria = $tomas[$i]["carga_horaria"];
  $estado = (empty($tomas[$i]["estado"])) ? "null" : $tomas[$i]["estado"] ;
  $sql = "
INSERT INTO curso (id, comision, carga_horaria, estado)
VALUES ({$id},  {$comision}, {$cargaHoraria}, {$estado});

UPDATE toma SET curso = {$id} 
WHERE id = {$idToma} ; 
";

  echo $sql;

}
  //el uso de parametros es dinamico
  //se puede definir un parametro opcional "display" que posee un string en formato json para facilitar el uso de tipos basicos


  //$first = Dba::all("id_persona");
  //print_r($first);
  //$sql = $sqlo->first();
  //echo "<pre>";
  //echo $sql;

  //$datos = Dba::fetchAll($sql);
  //print_r($datos)  ;
/*
  function id($p){ return $p["id"]; }
  $ids = array_map("id", $datos);

  $rows_ = Dba::getAll(ENTITY, $ids);
  $rows = $sqlo->jsonAll($rows_);

  for($i = 0; $i < count($datos); $i++){
    for($j = 0; $j < count($rows); $j++){
      if($datos[$i]["id"] == $rows[$j]["id"]) $rows[$j]["cantidad"] = $datos[$i]["cantidad"];
    }
  }
  echo json_encode($rows);*/
