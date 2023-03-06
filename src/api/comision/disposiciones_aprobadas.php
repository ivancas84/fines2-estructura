<?php

require_once("api/base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class ComisionDisposicionesAprobadasApi  extends BaseApi {
  public $entity_name = "disposicion";
  public $permission = "r";

  public function main() {
    $idComision =  file_get_contents("php://input");
    return $this->container->controller_("disposiciones_aprobadas_alumno_comision")->main($idComision);
  }
}

