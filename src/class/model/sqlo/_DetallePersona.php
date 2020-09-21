<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DetallePersonaSqlo extends EntitySqlo {

  public $entityName = "detalle_persona";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "descripcion, " ;
    $sql .= "creado, " ;
    $sql .= "archivo, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['descripcion'] . ", " ;
    $sql .= $row['creado'] . ", " ;
    $sql .= $row['archivo'] . ", " ;
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
    if (isset($row['descripcion'] )) $sql .= "descripcion = " . $row['descripcion'] . " ," ;
    if (isset($row['creado'] )) $sql .= "creado = " . $row['creado'] . " ," ;
    if (isset($row['archivo'] )) $sql .= "archivo = " . $row['archivo'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['arc_id'])) $row_["archivo_"] = $this->container->getValue('file', 'arc')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_id'])) $row_["persona_"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["detalle_persona"] = $this->container->getValue("detalle_persona")->_fromArray($row, "set");
    $row_["archivo"] = $this->container->getValue('file', 'arc')->_fromArray($row, "set");
    $row_["persona"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set");
    return $row_;
  }



}
