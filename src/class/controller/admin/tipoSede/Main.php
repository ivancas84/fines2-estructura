<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class TipoSedeAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("tipo_sede");
    $this->sqlo = EntitySqlo::getInstanceRequire("tipo_sede");
  }
  
}
