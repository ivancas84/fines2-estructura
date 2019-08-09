<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class CoordinadorAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("coordinador");
    $this->sqlo = EntitySqlo::getInstanceRequire("coordinador");
  }
  
}
