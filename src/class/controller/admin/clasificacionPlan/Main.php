<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class ClasificacionPlanAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("clasificacion_plan");
    $this->sqlo = EntitySqlo::getInstanceRequire("clasificacion_plan");
  }
  
}
