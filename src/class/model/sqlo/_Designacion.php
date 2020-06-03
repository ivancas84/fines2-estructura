<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DesignacionSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('designacion');
    $this->sql = EntitySql::getInstanceRequire('designacion');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "desde, " ;
    $sql .= "hasta, " ;
    $sql .= "alta, " ;
    $sql .= "cargo, " ;
    $sql .= "sede, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['desde'] . ", " ;
    $sql .= $row['hasta'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['cargo'] . ", " ;
    $sql .= $row['sede'] . ", " ;
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
    if (isset($row['desde'] )) $sql .= "desde = " . $row['desde'] . " ," ;
    if (isset($row['hasta'] )) $sql .= "hasta = " . $row['hasta'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['cargo'] )) $sql .= "cargo = " . $row['cargo'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["designacion"] = EntityValues::getInstanceRequire("designacion", $row);
    return $row_;
  }



}
