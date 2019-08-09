<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class Nomina2AdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("nomina2");
    $this->sqlo = EntitySqlo::getInstanceRequire("nomina2");
  }
  
}
