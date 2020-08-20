<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _TelefonoSqlo extends EntitySqlo {

  public $entityName = "telefono";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "tipo, " ;
    $sql .= "prefijo, " ;
    $sql .= "numero, " ;
    $sql .= "insertado, " ;
    $sql .= "eliminado, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['tipo'] . ", " ;
    $sql .= $row['prefijo'] . ", " ;
    $sql .= $row['numero'] . ", " ;
    $sql .= $row['insertado'] . ", " ;
    $sql .= $row['eliminado'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['tipo'] )) $sql .= "tipo = " . $row['tipo'] . " ," ;
    if (isset($row['prefijo'] )) $sql .= "prefijo = " . $row['prefijo'] . " ," ;
    if (isset($row['numero'] )) $sql .= "numero = " . $row['numero'] . " ," ;
    if (isset($row['insertado'] )) $sql .= "insertado = " . $row['insertado'] . " ," ;
    if (isset($row['eliminado'] )) $sql .= "eliminado = " . $row['eliminado'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['per_id'])) $row_["persona_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_')->_toArray();
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'per_dom_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["telefono"] = EntityValues::getInstanceRequire("telefono")->_fromArray($row);
    $row_["persona"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'per_dom_');
    return $row_;
  }



}
