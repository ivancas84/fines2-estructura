<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");
require_once("function/php_input.php");

class TomaPosesionPersistApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public function main(){
    $data = php_input();
    
    /**
     * $data["curso"]: Id curso
     * $data["email"]: Email abc
     */

    $render = $this->container->getRender("persona");
    $render->setCondition(["email","=",$data["email"]]);
    $persona = $this->container->getDb()->oneOrNull("persona", $render);

    if(!$persona) return false;

    $persistToma = $this->container->getControllerEntity("persist_sql", "toma_posesion")->id([
      "curso" => $data["curso"], "persona" => $persona["id"]
    ]);



    $this->container->getDb()->multi_query_transaction($persistToma["sql"]);
    $this->container->getController("email_registro")->main($persistToma["id"]);

    return true;
  }
}