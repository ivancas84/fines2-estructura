<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class AlumnoInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("alumno");
    $this->sqlo = EntitySqlo::getInstanceRequire("alumno");
  }
  
}
