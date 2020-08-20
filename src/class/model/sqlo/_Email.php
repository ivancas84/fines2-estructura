<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _EmailSqlo extends EntitySqlo {

  public $entityName = "email";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "email, " ;
    $sql .= "verificado, " ;
    $sql .= "insertado, " ;
    $sql .= "eliminado, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['email'] . ", " ;
    $sql .= $row['verificado'] . ", " ;
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
    if (isset($row['email'] )) $sql .= "email = " . $row['email'] . " ," ;
    if (isset($row['verificado'] )) $sql .= "verificado = " . $row['verificado'] . " ," ;
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
    $row_["email"] = EntityValues::getInstanceRequire("email")->_fromArray($row);
    $row_["persona"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'per_dom_');
    return $row_;
  }



}
