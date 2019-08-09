<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class LugarNacimientoAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("lugar_nacimiento");
    $this->sqlo = EntitySqlo::getInstanceRequire("lugar_nacimiento");
  }
  
}
