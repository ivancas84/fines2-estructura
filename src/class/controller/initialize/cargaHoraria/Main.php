<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class CargaHorariaInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("carga_horaria");
    $this->sqlo = EntitySqlo::getInstanceRequire("carga_horaria");
  }
  
}
