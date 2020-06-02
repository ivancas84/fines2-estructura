<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/model/db/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/Ma.php");

function obtenerIdPlanificacion($anio, $semestre,$plan){
    global $planificacion;
    foreach($planificacion as $p){
        if($p["anio"]==$anio && $p["semestre"]==$semestre && $p["plan"] == $plan) return $p["id"];
    }
}

Dba::$dataDbName = "planfi10_20203";

$planificacion = Dba::fetchAll("
SELECT id, anio, semestre, plan 
FROM planificacion
ORDER BY plan
");

Dba::$dataDbName = "planfi10_20202";

$distribucion_horaria = Dba::fetchAll("
SELECT id, anio, semestre, plan, horas_catedra, dia, asignatura 
FROM distribucion_horaria
ORDER BY plan
");

foreach($distribucion_horaria as $dh){
    $dh["planificacion"] = obtenerIdPlanificacion($dh["anio"], $dh["semestre"], $dh["plan"]);
    
    echo "
INSERT INTO planfi10_20203.distribucion_horaria (id, horas_catedra, dia, asignatura, planificacion) 
VALUES ('" . $dh["id"] . "', " . $dh["horas_catedra"] . ", " . $dh["dia"] . ", '" . $dh["asignatura"] . "', '" . $dh["planificacion"] . "');
<br>";
}
