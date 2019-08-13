<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class ClasificacionInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("clasificacion");
    $this->sqlo = EntitySqlo::getInstanceRequire("clasificacion");
  }
  
}
