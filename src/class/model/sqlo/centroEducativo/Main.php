<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class CentroEducativoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('centro_educativo');
    $this->sql = EntitySql::getInstanceRequire('centro_educativo');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "nombre, " ;
    $sql .= "cue, " ;
    $sql .= "domicilio, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['cue'] . ", " ;
    $sql .= $row['domicilio'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['nombre'] )) $sql .= "nombre = " . $row['nombre'] . " ," ;
    if (isset($row['cue'] )) $sql .= "cue = " . $row['cue'] . " ," ;
    if (isset($row['domicilio'] )) $sql .= "domicilio = " . $row['domicilio'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'dom')->_json($row);
      $row_["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["centro_educativo"] = EntityValues::getInstanceRequire("centro_educativo", $row);
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'dom_');
    return $row_;
  }



}
