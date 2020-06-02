<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/model/db/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/Ma.php");

Dba::$dataDbName = "planfi10_20202";

$planificacion = Dba::fetchAll("
SELECT DISTINCT anio, semestre, plan 
FROM distribucion_horaria
ORDER BY plan
");

foreach($planificacion as &$p){
    $p["id"] = uniqid();
    echo "
INSERT INTO planfi10_20203.planificacion (id, anio, semestre, plan) 
VALUES ('" . $p["id"] . "', '" . $p["anio"] . "', '" . $p["semestre"] . "', '" . $p["plan"] . "');
<br>";
}
