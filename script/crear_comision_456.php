<?php

require_once("../config/config.php");
require_once("class/controller/Dba.php");
require_once("class/model/Values.php");
require_once("class/model/Render.php");

$comision = EntityValues::getInstanceRequire("comision",DEFAULT_VALUE);
echo "<pre>";
print_r($comision);

/*
$render = new Render();
$render->setCondition([
  ["com_dvi_serie","=","C_191"]
]);
$rows = Dba::all("curso",$render);

echo "<table>";
foreach($rows as $row){
  echo "<tr>";
  echo "<td>".$row["id"]."</td>";
  echo "<td>".$row["toma_activa"]."</td>";
  echo "<td>".$row["ta_pro_nombres"]."</td>";
  echo "<td>".$row["ta_pro_apellidos"]."</td>";
  echo "<td>".$row["ta_observaciones"]."</td>";
  echo "</tr>";
}
echo "</table>";
*/