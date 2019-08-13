<?php

require_once("class/controller/Initialize.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class TelefonoInitializeControllerMain extends EntityInitializeController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("telefono");
    $this->sqlo = EntitySqlo::getInstanceRequire("telefono");
  }
  
}
