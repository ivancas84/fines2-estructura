<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class AsignaturaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("asignatura");
    $this->sqlo = EntitySqlo::getInstanceRequire("asignatura");
  }
  
}
