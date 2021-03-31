<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
class CantidadAlumnosAprobadosComisionApi extends BaseApi {

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $idsComisiones = php_input();

    $render = $this->container->getRender("calificacion");
    $render->setCondition([
      ["cur-comision","=",$idsComisiones],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ]);
    $render->setFields(["aprobados"=>"persona.count"]);
    $render->setGroup(["comision"=>"cur-comision"]);
    
    return $this->container->getDb()->select("calificacion",$render);
  }

}
