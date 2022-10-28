<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("model/db/Dba.php");
require_once("model/EntityRender.php");
require_once("model/Ma.php");

Dba::$dataDbName = "planfi10_20202";

$fecha_contralor = Dba::fetchAll("
SELECT DISTINCT fecha_contralor 
FROM toma
WHERE fecha_contralor IS NOT NULL
");

$anios = [];

foreach($fecha_contralor as $fec){
    $id = uniqid();
    $anio = substr($fec["fecha_contralor"], 0, 4);
    if(!key_exists($anio, $anios)) $anios[$anio] = 0;
    $anios[$anio]++;

    echo "
INSERT INTO planfi10_20203.planilla_docente (id, numero) 
VALUES ('" . $id . "', '" . $anio . "/". $anios[$anio] . "');

INSERT INTO planfi10_20203.contralor (id, fecha_contralor, planilla_docente) 
VALUES ('" . $id . "', '" . $fec["fecha_contralor"] . "', '" . $id . "');
<br>";
}
