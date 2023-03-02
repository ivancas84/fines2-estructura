<?php

require_once("api/persist.php");
require_once("function/php_input.php");

class TomaInscripcionEmailApi  extends PersistApi {
    public $permission = "r";

    public function main() {
        //$data["curso"]: Id curso
        //$data["email"]: Email abc
        $data = php_input();

        $persona = $this->container->query("persona")
        ->cond(["email","=",$data["email"]])
        ->fields()
        ->oneOrNull();

        if(!$persona) return false;

        $persist_toma = $this->container->controller("inscripcion_persist_sql", "toma")->main([
            "curso" => $data["curso"], "persona" => $persona["id"]
        ]);

        $this->container->db()->multi_query_transaction($persist_toma["sql"]);
        $this->container->controller("toma_posesion","email")->main($persist_toma["id"]);

        return true;
    }
}

