<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class LugarNacimientoInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("lugar_nacimiento");
    $this->sqlo = EntitySqlo::getInstanceRequire("lugar_nacimiento");
  }
  
}
