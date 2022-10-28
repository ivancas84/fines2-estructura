<?php

require_once("api/Base.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class CantidadAlumnosActivosComisionInfoApi  extends BaseApi {

  public function main() {
    $idComision_ = php_input();
    $render = $this->container->getEntityRender();
    $render->addCondition(["comision","=",$idComision_]);
    $render->addCondition(["activo","=",true]);
    $render->setSize(0);
    $render->setFields([
      "comision", "cantidad"=>"alumno.count"
    ]);

    $render->setGroup(["comision"]);
    return $this->container->db()->select("alumno_comision", $render);
  }
}

