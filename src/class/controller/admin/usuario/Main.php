<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class UsuarioAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("usuario");
    $this->sqlo = EntitySqlo::getInstanceRequire("usuario");
  }
  
}
