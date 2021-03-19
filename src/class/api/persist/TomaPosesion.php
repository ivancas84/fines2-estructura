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
     * $data["id"]: Id curso
     * $data["email_abc"]: Email abc
     */

    $persona = $this->container->getDb()->unique("persona", ["email_abc"=>$data["email_abc"]]);

    if(!$persona) return false;

    $persistToma = $this->container->getControllerEntity("persist_sql", "toma_posesion")->main([
      "curso" => $data["id"], "persona" => $persona["id"]
    ]);

    $this->container->getDb()->multi_query_transaction($persistToma["sql"]);
    $this->container->getControllerEntity("email", "registro")->main($persistToma["id"]);

    return true;
  }
}