<?php

require_once("api/Base.php");
require_once("function/php_input.php");
class CantidadAlumnosActivosComisionApi extends BaseApi {

  public function main() {
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    $idsComisiones = php_input();

    return $this->container->query("alumno_comision")
    ->cond([
      ["comision","=",$idsComisiones],
      ["activo","=",true],
    ])
    ->fields(["activos"=>"alumno.count"])
    ->group(["comision"=>"comision"])
    ->all();
    
  }

}
