<?php

require_once("class/controller/Admin.php");
require_once("class/model/Entity.php");
require_once("class/model/Sqlo.php");

class ComisionAdminControllerMain extends EntityAdminController {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("comision");
    $this->sqlo = EntitySqlo::getInstanceRequire("comision");
  }
  
}
