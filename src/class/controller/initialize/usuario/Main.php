<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class UsuarioInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("usuario");
    $this->sqlo = EntitySqlo::getInstanceRequire("usuario");
  }
  
}
