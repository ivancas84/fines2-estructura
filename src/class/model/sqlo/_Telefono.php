<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _TelefonoSqlo extends EntitySqlo {

  public $entityName = "telefono";

  public function insert(array $row){ //@override
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

  public function _update(array $row){ //@override
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
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_id'])) $row_["persona_"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["telefono"] = $this->container->getValue("telefono")->_fromArray($row, "set");
    $row_["persona"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set");
    return $row_;
  }



}
