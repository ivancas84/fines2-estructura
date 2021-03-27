<?php

require_once("class/api/Persist.php");
require_once("function/php_input.php");

class RegistroDocentePersistApi extends PersistApi {

  public function main(){
    $data = php_input();

    if(empty($data)) throw new Exception("Se está intentando persistir un conjunto de datos vacío");

    $values = $this->container->getValues("persona")->_fromArray($data)->_reset();
    if(!$values->_check()) throw new Exception($values->_getLogs()->toString());
    
    $detail = [];
    /**
     * Solo se registrara el detalle de las actualizaciones
     * El cache debe actualizarse solo con las actualizaciones
     * Las inserciones no se encuentran cacheadas y seran posteriormente consultadas
     */
    
    $row = $this->container->getDb()->unique("persona", $values->_toArray());
    if($row) throw new Exception("Ya se encuentra registrado");

    $values->_setDefault();
    $persist = $this->container->getSqlo("persona")->insert($values->_toArray());
    $this->container->getDb()->multi_query_transaction_log($persist["sql"]);
    
    return ["id" => $persist["id"], "detail" => $detail];
  }
}