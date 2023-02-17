<?php

require_once("api/Persist.php");
require_once("controller/ModelTools.php");
require_once("function/array_combine_keys.php");
require_once("function/array_combine_key.php");
require_once("function/php_input.php");

class ComisionGenerarHorariosApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public function main(){
    $data = php_input();

    if(empty($data["comision"]) || empty($data["comision"]["id"])) throw new Exception("Dato no definido: id comision");
    if(empty($data["horarios"]) || empty($data["horarios"]["dias"])) throw new Exception("Dato no definido: dias");
    if(empty($data["horarios"]) || empty($data["horarios"]["hora_inicio"])) throw new Exception("Dato no definido: hora inicio");

    $persist = $this->container->controller_("horarios_comision_persist_sql")->main([
      "id" => $data["comision"]["id"],
      "dias" => $data["horarios"]["dias"],
      "hora_inicio" => $data["horarios"]["hora_inicio"]
    ]);

    $persist = $this->container->db()->multi_query_transaction($persist["sql"]);

    return [
      "id" => $data["comision"]["id"],
      "detail" => $persist["detail"]
    ];
  }

}