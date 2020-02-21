<?php

require_once("../config/config.php");

require_once("class/controller/persist/HorariosComisionesGrupo.php");
require_once("class/controller/persist/HorariosComision.php");


$grupo = [
    "fecha_anio"=>"2020",
    "fecha_semestre"=>"1",
    "modalidad"=>"1",
    "sed_centro_educativo"=>"1"
];


$controller = new HorariosComisionesGrupoPersist();
$controller->main($grupo);


//Dba::dbInstance()->multiQueryTransaction($controller->getSql());
//Dba::dbClose();
//echo "<pre>";
//print_r($controller);