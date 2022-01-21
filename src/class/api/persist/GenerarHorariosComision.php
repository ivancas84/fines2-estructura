<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");
require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");
require_once("function/php_input.php");

class GenerarHorariosComisionPersistApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public function main(){
    $data = php_input();

    if(empty($data["comision"]) || empty($data["comision"]["id"])) throw new Exception("Dato no definido: id comision");
    if(empty($data["horarios"]) || empty($data["horarios"]["dias"])) throw new Exception("Dato no definido: dias");
    if(empty($data["horarios"]) || empty($data["horarios"]["hora_inicio"])) throw new Exception("Dato no definido: hora inicio");


    $data = [
      "id" => $data["comision"]["id"],
      "dias" => $data["horarios"]["dias"],
      "hora_inicio" => $data["horarios"]["hora_inicio"]
    ];
    $this->id = $data["comision"]["id"];
    $this->horaInicio = $data["horarios"]["hora_inicio"];
    $this->dias = $data["horarios"]["dias"];

    $persist = $this->container->getController("horarios_comision_persist_sql");

    $this->container->multi_query_transaction($persist["sql"]);

    return [
      "id" => $data["comision"]["id"],
      "detail" => $persist["detail"]
    ];
  }

}