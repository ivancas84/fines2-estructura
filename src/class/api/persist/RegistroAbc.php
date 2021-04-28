<?php

require_once("class/api/Persist.php");
require_once("function/nombres_parecidos.php");
require_once("function/php_input.php");

class RegistroAbcPersistApi extends PersistApi {

  public function main(){
    $data = php_input();

    if(empty($data)) throw new Exception("Se está intentando persistir un conjunto de datos vacío");

    $value = $this->container->getValue("persona")->_fromArray($data, "set")->_call("reset");
    $row = $this->container->getDb()->unique("persona", $value->_toArray("json"));

    if($row){
      $personaExistente = $this->container->getValue("persona")->_fromArray($row, "set");
      if($personaExistente->_get("numero_documento") != $value->_get("numero_documento")) throw new Exception("El número de documento ingresado no es válido");
      
      if(!Validation::is_empty($personaExistente->_get("email_abc")) 
      && ($personaExistente->_get("email_abc") != $value->_get("email_abc")))
         throw new Exception("El email ABC no es válido");
      
      if(!nombres_parecidos($personaExistente->_get("nombre"), $value->_get("nombre")))  throw new Exception("El nombre ingresado no es válido");

      $value->_set("id",$personaExistente->_get("id"));
      $sql = $this->container->getSqlo("persona")->update($value->_toArray("sql"));
    } else {
      $value->_call("setDefault");
      $value->set("id",uniqid());
      $sql = $this->container->getSqlo("persona")->insert($value->_toArray("sql"));
    }
    
    $persistToma = $this->container->getControllerEntity("persist_sql", "toma_posesion")->id([
      "curso" => $data["curso"], "persona" => $value->_get("id")
    ]);

    $sql .= $persistToma["sql"];
    $detail = ["persona".$value->_get("id"), "toma".$persistToma["id"]];

    $this->container->getDb()->multi_query_transaction($sql);
    $this->container->getControllerEntity("email", "registro")->main($persistToma["id"]);

    return ["id" => $value->_get("id"), "detail" => $detail];
  }
}