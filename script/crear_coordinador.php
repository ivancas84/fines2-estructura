<?php

require_once("../config/config.php");
require_once("class/model/Dba.php");
require_once("class/model/Render.php");
require_once("class/model/Values.php");
require_once("class/model/Sqlo.php");



echo "<pre>";
$db = Dba::dbInstance();
$coordinador = EntityValues::getInstanceRequire("coordinador",DEFAULT_VALUE);
$coordinador->setPersona("1532315811299334");
$coordinador->setSede("1641266746876650");
$db->query(EntitySqlo::getInstanceRequire("coordinador")->insert($coordinador->_toArray())["sql"]);

$coordinador = EntityValues::getInstanceRequire("coordinador",DEFAULT_VALUE);
$coordinador->setPersona("1532315811299334");
$coordinador->setSede("1641267516182806");
$db->query(EntitySqlo::getInstanceRequire("coordinador")->insert($coordinador->_toArray())["sql"]);

$coordinador = EntityValues::getInstanceRequire("coordinador",DEFAULT_VALUE);
$coordinador->setPersona("1532315811299334");
$coordinador->setSede("1644599001608428");
$db->query(EntitySqlo::getInstanceRequire("coordinador")->insert($coordinador->_toArray())["sql"]);
