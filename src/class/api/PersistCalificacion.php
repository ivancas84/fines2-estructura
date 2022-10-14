<?php

require_once("class/api/PersistRelArrayUnique.php");

class PersistCalificacionApi extends PersistRelArrayUniqueApi{

  public function main(){
    $this->container->getAuth()->authorize($this->entityName, $this->permission);
    if(empty($this->params)) $this->params = php_input();
    $this->assignParams();

    $render = $this->container->getEntityRender("persona");
    
    $value = $this->container->getValue("persona")->_fromArray($this->params["per"], "set");

    $datosPersonaExistente = $this->container->getDb()->unique("persona", $value->_toArray("json"));
    
    if (!empty($datosPersonaExistente)){ 
      $value->_set("id",$datosPersonaExistente["id"]);
      $value->_call("reset")->_call("check");
      $value->checkNombresParecidos(
        $this->container->getValue("persona")->_fromArray($datosPersonaExistente, "set")
      );
      if($value->logs->isError()) throw new Exception($value->logs->toString());
      $sql = $this->container->getEntitySqlo("persona")->update($value->_toArray("sql"));
    } else {
      $value->_call("setDefault");
      $value->_set("id",uniqid()); //id habitualmente esta en null y no se asigna al definir valores por defecto
      $value->_call("reset")->_call("check");
      if($value->logs->isError()) throw new Exception($value->logs->toString());
      $sql = $this->container->getEntitySqlo("persona")->insert($value->_toArray("sql"));
    }
    $persist = ["id" => $value->_get("id"),"sql"=>$sql];
    $detail = ["persona".$persist["id"]];

    $this->params["calificacion"]["persona"] = $persist["id"];
    $persist = $this->container->getControllerEntity("persist_sql", "calificacion")->id($this->params["calificacion"]);
    $sql .= $persist["sql"];
    $this->container->getDb()->multi_query_transaction($sql);

    array_push($detail, "calificacion".$persist["id"]);

    return ["id" => $persist["id"], "detail" => $detail];
    
  }
}



