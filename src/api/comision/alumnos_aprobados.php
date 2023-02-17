<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class ComisionAlumnosAprobadosApi  extends BaseApi {

  public function main() {
    $idComision_ = php_input();
    return $this->container->controller_("cantidad_aprobados_comision")->main($idComision_);
  }
}

