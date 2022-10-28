<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class CantidadAlumnosActivosComisionInfoApi  extends BaseApi {

  public function main() {
    $idComision_ = php_input();

    return $this->container->query("alumno_comision")
    ->cond(["comision","=",$idComision_])
    ->cond(["activo","=",true])
    ->size(0)
    ->fields([
      "comision", "cantidad"=>"alumno.count"
    ])
    ->group(["comision"]);
  }
}

