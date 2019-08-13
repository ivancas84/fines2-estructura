<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class CoordinadorInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("coordinador");
    $this->sqlo = EntitySqlo::getInstanceRequire("coordinador");
  }
  
}
