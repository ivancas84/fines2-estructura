<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class NominaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("nomina");
    $this->sqlo = EntitySqlo::getInstanceRequire("nomina");
  }
  
}
