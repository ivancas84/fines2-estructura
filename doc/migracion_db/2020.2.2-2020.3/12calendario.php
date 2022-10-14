<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/model/db/Dba.php");
require_once("class/model/EntityRender.php");
require_once("class/model/Ma.php");

Dba::$dataDbName = "planfi10_20202";

$calendario = Dba::fetchAll("
SELECT DISTINCT fecha_anio, fecha_semestre 
FROM comision
WHERE fecha_anio IS NOT NULL
AND fecha_semestre IS NOT NULL
ORDER BY fecha_anio, fecha_semestre
");

foreach($calendario as &$c){
    $c["id"] = uniqid();
    echo "
INSERT INTO planfi10_20203.calendario (id, anio, semestre) 
VALUES ('" . $c["id"] . "', '" . $c["fecha_anio"] . "', " . $c["fecha_semestre"] . ");
<br>";
}
