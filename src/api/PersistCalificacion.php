<?php

require_once("api/PersistRelArrayUnique.php");

class PersistCalificacionApi extends PersistRelArrayUniqueApi{

  public function main(){
    $this->container->getAuth()->authorize($this->entity_name, $this->permission);
    if(empty($this->params)) $this->params = php_input();
    $this->assignParams();

    $render = $this->container->getEntityRender("persona");
    
    $value = $this->container->value("persona")->_fromArray($this->params["per"], "set");

    $datosPersonaExistente = $this->container->db()->unique("persona", $value->_toArray("json"));
    
    if (!empty($datosPersonaExistente)){ 
      $value->_set("id",$datosPersonaExistente["id"]);
      $value->_call("reset")->_call("check");
      $value->checkNombresParecidos(
        $this->container->value("persona")->_fromArray($datosPersonaExistente, "set")
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
    $persist = $this->container->controller("persist_sql", "calificacion")->id($this->params["calificacion"]);
    $sql .= $persist["sql"];
    $this->container->db()->multi_query_transaction($sql);

    array_push($detail, "calificacion".$persist["id"]);

    return ["id" => $persist["id"], "detail" => $detail];
    
  }
}



