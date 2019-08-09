<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class CargaHorariaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("carga_horaria");
    $this->sqlo = EntitySqlo::getInstanceRequire("carga_horaria");
  }
  
}
