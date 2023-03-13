<?php

require_once("api/persist.php");
require_once("controller/ModelTools.php");
require_once("function/php_input.php");

class DocenteGenerarTomaApi extends PersistApi {
  public function main(){
    $data = php_input();
    
    /**
     * $data["curso"]: Id curso
     * $data["email"]: Email abc
     */

    $render = $this->container->getEntityRender("persona");
    $render->setCondition(["email","=",$data["email"]]);
    $persona = $this->container->db()->oneOrNull("persona", $render);

    if(!$persona) return false;

    $persistToma = $this->container->controller("persist_sql", "toma_posesion")->id([
      "curso" => $data["curso"], "persona" => $persona["id"]
    ]);



    $this->container->db()->multi_query_transaction($persistToma["sql"]);
    $this->container->controller_("email_registro")->main($persistToma["id"]);

    return true;
  }
}