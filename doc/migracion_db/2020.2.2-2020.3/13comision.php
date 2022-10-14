<?php

//Ejecutar en el server
require_once($_SERVER["DOCUMENT_ROOT"]."/config/config.php");
require_once("class/model/db/Dba.php");
require_once("class/model/EntityRender.php");
require_once("class/model/Ma.php");

function obtenerIdPlanificacion($anio, $semestre,$plan){
    if(empty($anio) || empty($semestre) || empty($plan)) return "null";

    global $planificacion;
    foreach($planificacion as $p){
        if($p["anio"]==$anio && $p["semestre"]==$semestre && $p["plan"] == $plan) return "'".$p["id"]."'";
    }

    return "null";
}

function obtenerIdCalendario($fechaAnio, $fechaSemestre){
    if(empty($fechaAnio) || empty($fechaSemestre)) return "null";

    global $calendario;
    foreach($calendario as $cal){
        if($cal["anio"]==$fechaAnio && $cal["semestre"]==$fechaSemestre) return "'".$cal["id"]."'";
    }

    return "null";
}

Dba::$dataDbName = "planfi10_20203";

$planificacion = Dba::fetchAll("
SELECT id, anio, semestre, plan 
FROM planificacion
");

$calendario = Dba::fetchAll("
SELECT DISTINCT id, anio, semestre 
FROM calendario
");

Dba::$dataDbName = "planfi10_20202";

$comision = Dba::fetchAll("
SELECT id, turno, division, anio, semestre, comentario, autorizada, apertura, publicada, fecha_anio, fecha_semestre, observaciones, alta, sede, plan, modalidad
FROM comision
");

foreach($comision as $c){
    $c["planificacion"] = obtenerIdPlanificacion($c["anio"], $c["semestre"], $c["plan"]);
    $c["calendario"] = obtenerIdCalendario($c["fecha_anio"], $c["fecha_semestre"]);
    $c["turno"] = (empty($c["turno"])) ? "null" : "'".$c["turno"]."'";
    $c["autorizada"] = (settypebool($c["autorizada"])) ? "true": "false";
    $c["apertura"] = (settypebool($c["apertura"])) ? "true": "false";
    $c["publicada"] = (settypebool($c["publicada"])) ? "true": "false";
    $c["observaciones"] = (empty($c["observaciones"])) ? "null": "'".$c["observaciones"]."'";
    $c["comentario"] = (empty($c["comentario"])) ? "null": "'".$c["comentario"]."'";

    echo "
INSERT INTO planfi10_20203.comision (id, turno, division, comentario, autorizada, apertura, publicada, observaciones, alta, sede, modalidad, planificacion, calendario) 
VALUES ('" . $c["id"] . "', " . $c["turno"] . ", '" . $c["division"] . "', " . $c["comentario"] . ", " . $c["autorizada"] . ", " . $c["apertura"] . ", " . $c["publicada"] . ", " . $c["observaciones"] . ", '" . $c["alta"] . "', '" . $c["sede"] . "', '" . $c["modalidad"] . "', " . $c["planificacion"] . ", " . $c["calendario"] . ");
<br>";
}
