<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/model/db/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/Ma.php");

function obtenerIdPlanillaDocente($fechaContralor){
    global $fecha_contralor;
    foreach($fecha_contralor as $p){
        if($p["fecha_contralor"]==$fechaContralor) return "'".$p["id"]."'";
    }

    return "null";
}

Dba::$dataDbName = "planfi10_20202";

$tomas = Dba::fetchAll("
SELECT DISTINCT id, fecha_contralor 
FROM toma
WHERE fecha_contralor IS NOT NULL
");


Dba::$dataDbName = "planfi10_20203";

//el id de la planilla docente es el mismo que el contralor
$fecha_contralor = Dba::fetchAll("
SELECT DISTINCT id, fecha_contralor 
FROM contralor
");

foreach($tomas as $t){
    $t["planilla_docente"] = obtenerIdPlanillaDocente($t["fecha_contralor"]);

    echo "
UPDATE planfi10_20203.toma SET planilla_docente = " . $t["planilla_docente"] . "
WHERE id = '" . $t["id"] . "';
<br>";
}
