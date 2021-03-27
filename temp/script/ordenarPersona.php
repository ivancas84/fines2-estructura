<?php

/**
 * @todo Implementar render en el getall
 */
require_once("../src/config/config.php");

require_once("class/controller/Dba.php");
require_once("class/model/Data.php");

require_once("config/structure.php");
require_once("config/modelClasses.php");
require_once("config/entityClasses.php");
require_once("config/valuesClasses.php");


$render = new Render();
$render->setOrder(["ip__numero_documento" => "ASC"]);

$idPersonaSqlo = new PersonaSqlo();
$sql = $idPersonaSqlo->all($render);