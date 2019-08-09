<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class PersonaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("persona");
    $this->sqlo = EntitySqlo::getInstanceRequire("persona");
  }
  
}
