<?php

require_once("../config/config.php");
require_once("class/controller/Dba.php");
require_once("class/model/Render.php");

$render = new Render();
$render->setCondition([
  ["numero","=",["97","98","99"]]
]);
$rows = Dba::all("sede",$render);

imprimir_rows($rows);



function imprimir_rows($rows){
  echo "<table>";
  foreach($rows as $row){
    echo "<tr>";
    echo "<td>".$row["id"]."</td>";
    echo "<td>".$row["numero"]."</td>";
    echo "</tr>";
  }
  echo "</table>";
  }