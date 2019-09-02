<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class NominaInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("nomina");
    $this->sqlo = EntitySqlo::getInstanceRequire("nomina");
  }
  
}
