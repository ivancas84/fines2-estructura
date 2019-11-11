<?php

require_once("../config/config.php");
require_once("class/controller/Dba.php");
require_once("class/model/Render.php");
require_once("function/array_unique_key.php");
require_once("function/array_group_value.php");

$render = new Render();
$render->setCondition([
  ["numero","=", true]
]);
$render->setOrder(["numero"=>"ASC"]);
$sedes =Dba::all("sede",$render);
$idSedes = array_unique_key($sedes, "id");


$render = new Render();
$render->setCondition([
  ["sed_id","=", $idSedes]
]);
$referentes =Dba::all("referente",$render);
$sedesReferentes = array_group_value($referentes, "sede");

  echo "<table>";
  foreach($sedes as $sede){
    $r = EntitySqlo::getInstanceRequire("sede")->values($sede);
    echo "<tr>";
    echo "<td>".$r["sede"]->numero()."</td>";
    echo "<td>".$r["sede"]->nombre()."</td>";
    echo "<td>".$r["domicilio"]->label()."</td>";
    echo "<td>";
    if(array_key_exists($r["sede"]->id(), $sedesReferentes)){
      echo "<table>";
      foreach($sedesReferentes[$r["sede"]->id()] as $referente){
        $re = EntitySqlo::getInstanceRequire("referente")->values($referente);
        echo "<tr><td>".$re["persona"]->nombre()."</td>";
        echo "<td>".$re["persona"]->telefonos()."</td></tr>";
      }
      echo "</table>";
    }
    echo"</td>";
    echo "</tr>";
  }
  echo "</table>";