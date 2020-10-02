<?php

require_once("class/api/Persist.php");
require_once("function/nombres_parecidos.php");

class RegistroAbcPersistApi extends PersistApi {

  public function main(){
    $data = Filter::jsonPostRequired();

    if(empty($data)) throw new Exception("Se está intentando persistir un conjunto de datos vacío");

    $value = $this->container->getValue("persona")->_fromArray($data, "set")->_call("reset")->_call("_check");
    if($value->_getLogs()->isError()) throw new Exception($value->_getLogs()->toString());

    $row = $this->container->getDb()->unique("persona", $value->_toArray());

    if($row){
      $personaExistente = $this->container->getValue("persona")->_fromArray($row, "set");
      if($personaExistente->numeroDocumento() != $value->numeroDocumento()) throw new Exception("El número de documento ingresado no es válido");
      
      if(!Validation::is_empty($personaExistente->emailAbc()) 
      && ($personaExistente->emailAbc() != $value->emailAbc()))
         throw new Exception("El email ABC no es válido");
      
      if(!nombres_parecidos($personaExistente->nombre(), $value->nombre()))  throw new Exception("El nombre ingresado no es válido");

      $value->setId($personaExistente->id());
      $sql = $this->container->getSqlo("persona")->update($value->_toArray("sql"));
    } else {
      $value->_call("setDefault");
      $value->setId(uniqid());
      $sql = $this->container->getSqlo("persona")->insert($value->_toArray("sql"));
    }
    
    $persistToma = $this->container->getControllerEntity("persist_sql", "toma_posesion")->main([
      "curso" => $data["curso"], "persona" => $value->id()
    ]);

    $sql .= $persistToma["sql"];
    $detail = ["persona".$value->id(), "toma".$persistToma["id"]];

    $this->container->getDb()->multi_query_transaction_log($sql);
    $this->container->getControllerEntity("email", "registro")->main($persistToma["id"]);

    return ["id" => $value->id(), "detail" => $detail];
  }
}