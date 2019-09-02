<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class AsignaturaInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("asignatura");
    $this->sqlo = EntitySqlo::getInstanceRequire("asignatura");
  }
  
}
