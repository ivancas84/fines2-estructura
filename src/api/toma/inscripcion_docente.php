<?php

require_once("api/persist.php");
require_once("function/php_input.php");

class TomaInscripcionDocenteApi  extends PersistApi {
    public $permission = "w";

    public function main() {
        //datos de persona que incluye el id de curso
        $data = php_input();

        if(empty($data)) throw new Exception("Se está intentando persistir un conjunto de datos vacío");

        $value = $this->container->value("persona")->_fromArray($data, "set")->_call("reset");
        $row = $this->container->query("persona")->unique($value->_toArray("json"))->fields()->one();

        if($row){
            $personaExistente = $this->container->value("persona")->_fromArray($row, "set");
            if($personaExistente->_get("numero_documento") != $value->_get("numero_documento")) throw new Exception("El número de documento ingresado no es válido");
        
            if(!Validation::is_empty($personaExistente->_get("email")) 
            && ($personaExistente->_get("email") != $value->_get("email")))
                throw new Exception("No puede tomar posesión. Se encuentra registrado con otro email. Comuníquese con la coordinación para actualizar su correo electrónico.");
            
            if(!nombres_parecidos($personaExistente->_get("nombre"), $value->_get("nombre")))  throw new Exception("El nombre ingresado no es válido");

            $value->_set("id",$personaExistente->_get("id"));
            $sql = $this->container->persist("persona")->update($value->_toArray("sql"));
        } else {
            $value->_call("setDefault");
            $value->_set("id",uniqid());
            $sql = $this->container->persist("persona")->insert($value->_toArray("sql"));
        }
        
        $persistToma = $this->container->controller("inscripcion_persist_sql", "toma")->main([
            "curso" => $data["curso"], "persona" => $value->_get("id")
        ]);

        $sql .= $persistToma["sql"];
        $detail = ["persona".$value->_get("id"), "toma".$persistToma["id"]];

        // echo $sql;
        $this->container->db()->multi_query_transaction($sql);
        $this->container->controller("toma_posesion","email")->main($persistToma["id"]);
        return ["id" => $value->_get("id"), "detail" => $detail];
    }
}

