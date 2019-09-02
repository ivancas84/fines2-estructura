<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class HorarioAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("horario");
    $this->sqlo = EntitySqlo::getInstanceRequire("horario");
  }
  
}
