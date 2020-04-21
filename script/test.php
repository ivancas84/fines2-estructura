<?php

require_once("../config/config.php");
require_once("class/controller/ModelTools.php");

$cargasHorarias = ModelTools::cargasHorarias(4,1,1);

echo "<pre>";
print_r($cargasHorarias);