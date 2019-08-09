<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class IdPersonaAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("id_persona");
    $this->sqlo = EntitySqlo::getInstanceRequire("id_persona");
  }
  
}
