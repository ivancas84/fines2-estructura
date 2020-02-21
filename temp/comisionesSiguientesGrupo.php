<?php

echo "<script>window.close();</script>";


require_once("../config/config.php");

require_once("class/controller/persist/ComisionesSiguientesGrupo.php");



$grupo = [
    "fecha_anio"=>"2020",
    "fecha_semestre"=>"1",
    "modalidad"=>"1",
    "sed_centro_educativo"=>"1"
];



$controller = new ComisionesSiguientesGrupoPersist();
$controller->main($grupo);
echo "<pre>";
echo $controller->getSql();


//Dba::dbInstance()->multiQueryTransaction($controller->getSql());
//Dba::dbClose();
//echo "<pre>";
//print_r($controller);