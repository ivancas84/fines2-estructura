<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class ClasificacionAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("clasificacion");
    $this->sqlo = EntitySqlo::getInstanceRequire("clasificacion");
  }
  
}
