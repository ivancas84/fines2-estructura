<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class DisposicionesAprobadasComisionInfoApi  extends BaseApi {
  public $entityName = "disposicion";
  public $permission = "r";

  public function main() {
    $idComision =  file_get_contents("php://input");
    return $this->container->getController("disposiciones_aprobadas_alumno_comision")->main($idComision);
  }
}

