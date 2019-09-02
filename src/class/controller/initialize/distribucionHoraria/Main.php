<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class DistribucionHorariaInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("distribucion_horaria");
    $this->sqlo = EntitySqlo::getInstanceRequire("distribucion_horaria");
  }
  
}
