<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class TomaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("toma");
    $this->sqlo = EntitySqlo::getInstanceRequire("toma");
  }
  
}
