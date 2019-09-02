<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class PlanAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("plan");
    $this->sqlo = EntitySqlo::getInstanceRequire("plan");
  }
  
}
