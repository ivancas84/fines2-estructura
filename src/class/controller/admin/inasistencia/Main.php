<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class InasistenciaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("inasistencia");
    $this->sqlo = EntitySqlo::getInstanceRequire("inasistencia");
  }
  
}
