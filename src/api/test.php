<?php

/**
 * @todo Implementar render en el getall
 */
require_once("class/Filter.php");
require_once("class/model/Dba.php");
require_once("class/model/RenderAux.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");


  //el uso de parametros es dinamico
  //se puede definir un parametro opcional "display" que posee un string en formato json para facilitar el uso de tipos basicos


  $render = new RenderAux();
  $render->setAggregate(["_cantidad"]);

  $sqlo = Sqlo::getInstanceString("asignatura");
  $sql = $sqlo->advanced($render);
  echo "<pre>";
  echo $sql;

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
