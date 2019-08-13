<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class InasistenciaInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("inasistencia");
    $this->sqlo = EntitySqlo::getInstanceRequire("inasistencia");
  }
  
}
