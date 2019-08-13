<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class PermisoInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("permiso");
    $this->sqlo = EntitySqlo::getInstanceRequire("permiso");
  }
  
}
