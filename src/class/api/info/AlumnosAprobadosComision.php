<?php

require_once("class/api/Base.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class AlumnosAprobadosComisionInfoApi  extends BaseApi {

  public function main() {
    $idComision_ = php_input();
    return $this->container->getController("alumnos_aprobados_comision")->main($idComision_);
  }
}

