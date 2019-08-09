<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class AlumnoAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("alumno");
    $this->sqlo = EntitySqlo::getInstanceRequire("alumno");
  }
  
}
