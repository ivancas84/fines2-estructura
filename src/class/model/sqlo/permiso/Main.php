<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class PermisoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('permiso');
    $this->sql = EntitySql::getInstanceRequire('permiso');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "alta, " ;
    $sql .= "baja, " ;
    $sql .= "rol, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['rol'] . ", " ;
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
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['rol'] )) $sql .= "rol = " . $row['rol'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['rol_id'])){
      $json = EntitySql::getInstanceRequire('rol', 'rol')->_json($row);
      $row_["rol_"] = $json;
    }
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["permiso"] = EntityValues::getInstanceRequire("permiso", $row);
    $row_["rol"] = EntityValues::getInstanceRequire('rol', $row, 'rol_');
    $row_["persona"] = EntityValues::getInstanceRequire('id_persona', $row, 'per_');
    return $row_;
  }



}
