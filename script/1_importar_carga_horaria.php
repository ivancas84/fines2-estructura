<?php

require_once("../config/config.php");

require_once("class/controller/import/cargaHoraria/CargaHoraria.php");

set_time_limit ( 0 );

$import = new CargaHorariaImport();
$import->id = "carga_horaria";
$import->mode="tab";
$import->source = $_POST["source"];
$import->pathSummary = PATH_ROOT . "doc/informe/" . date("YmdHis") . "_".$import->id;
//$import->main();
$import->define();
$import->identify();
$import->query();
$import->process();


echo "<pre>";
print_r($import);
