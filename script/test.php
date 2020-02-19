<?php

require_once("../config/config.php");

require_once("class/controller/persist/ComisionesSiguientes.php");
require_once("class/controller/persist/HorariosCursosGrupo.php");
require_once("class/controller/persist/HorariosComision.php");



$grupo = [
    "fecha_anio"=>"2020",
    "fecha_semestre"=>"1",
    "modalidad"=>"1",
    "sed_centro_educativo"=>"1"
];

$data = [
    "dia_" => [1,2,4],
    "hora_inicio" => "10:00",
    "id" => "5e4c1eb8d8621",
];

//$controller = new HorariosCursosGrupoPersist();
//$controller = new ComisionesSiguientesPersist();
$controller = new HorariosComisionPersist();
$controller->main($data);


//Dba::dbInstance()->multiQueryTransaction($controller->getSql());
//Dba::dbClose();
//echo "<pre>";
//print_r($controller);