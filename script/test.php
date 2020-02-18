<?php

require_once("../config/config.php");

require_once("class/controller/persist/ComisionesSiguientes.php");
require_once("class/controller/persist/HorariosCursosGrupo.php");


$grupo = [
    "fecha_anio"=>"2020",
    "fecha_semestre"=>"1",
    "modalidad"=>"1",
    "sed_centro_educativo"=>"1"
];

$controller = new HorariosCursosGrupoPersist();
//$controller = new ComisionesSiguientesPersist();
$controller->main($grupo);


//Dba::dbInstance()->multiQueryTransaction($controller->getSql());
//Dba::dbClose();
echo "<pre>";

print_r($controller);