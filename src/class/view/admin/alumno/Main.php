<?php

require_once("class/view/Admin.php");
require_once("class/model/Entity.php");

class AlumnoViewAdminMain extends EntityViewAdmin {

  public function __construct() {
    $this->entity = Entity::getInstanceRequire("alumno");
  }
  
}
