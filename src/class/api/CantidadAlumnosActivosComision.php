<?php

require_once("class/api/Base.php");
require_once("function/php_input.php");
class CantidadAlumnosActivosComisionApi extends BaseApi {

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $idsComisiones = php_input();

    $render = $this->container->getRender("alumno_comision");
    $render->setCondition([
      ["comision","=",$idsComisiones],
      ["activo","=",true],
    ]);
    $render->setFields(["activos"=>"persona.count"]);
    $render->setGroup(["comision"=>"comision"]);
    
    return $this->container->getDb()->select("alumno_comision",$render);
  }

}
