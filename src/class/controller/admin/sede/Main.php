<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class SedeAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("sede");
    $this->sqlo = EntitySqlo::getInstanceRequire("sede");
  }
  
}
