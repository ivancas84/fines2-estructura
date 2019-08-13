<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class ComisionInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("comision");
    $this->sqlo = EntitySqlo::getInstanceRequire("comision");
  }
  
}
