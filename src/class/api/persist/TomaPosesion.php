<?php

require_once("class/api/Persist.php");
require_once("class/controller/ModelTools.php");

class TomaPosesionPersistApi extends PersistApi {
  /**
   * Registro de cursos de una comision
   */

  public function main(){
    $data = Filter::jsonPostRequired();
    
    /**
     * $data["id"]: Id curso
     * $data["email_abc"]: Email abc
     */

    $persona = $this->container->getDb()->unique("persona", ["email_abc"=>$data["email_abc"]]);

    if(!$persona) return false;

    $persistToma = $this->container->getControllerEntity("persist_sql", "toma_posesion")->main([
      "curso" => $data["id"], "persona" => $persona["id"]
    ]);

    $this->container->getDb()->multi_query_transaction_log($persistToma["sql"]);

    return true;
  }
}