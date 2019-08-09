<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class PermisoAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("permiso");
    $this->sqlo = EntitySqlo::getInstanceRequire("permiso");
  }
  
}
