<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class DistribucionHorariaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("distribucion_horaria");
    $this->sqlo = EntitySqlo::getInstanceRequire("distribucion_horaria");
  }
  
}
