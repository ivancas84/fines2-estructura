<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class PersonaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('persona');
    $this->sql = EntitySql::getInstanceRequire('persona');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "alta, " ;
    $sql .= "lugar_nacimiento, " ;
    $sql .= "id_persona, " ;
    $sql .= "domicilio, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['lugar_nacimiento'] . ", " ;
    $sql .= $row['id_persona'] . ", " ;
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
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['lugar_nacimiento'] )) $sql .= "lugar_nacimiento = " . $row['lugar_nacimiento'] . " ," ;
    if (isset($row['id_persona'] )) $sql .= "id_persona = " . $row['id_persona'] . " ," ;
    if (isset($row['domicilio'] )) $sql .= "domicilio = " . $row['domicilio'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['ln_id'])){
      $json = EntitySql::getInstanceRequire('lugar_nacimiento', 'ln')->_json($row);
      $row_["lugar_nacimiento_"] = $json;
    }
    if(!is_null($row['ip_id'])){
      $json = EntitySql::getInstanceRequire('id_persona', 'ip')->_json($row);
      $row_["id_persona_"] = $json;
    }
    if(!is_null($row['dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'dom')->_json($row);
      $row_["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["persona"] = EntityValues::getInstanceRequire("persona", $row);
    $row_["lugar_nacimiento"] = EntityValues::getInstanceRequire('lugar_nacimiento', $row, 'ln_');
    $row_["id_persona"] = EntityValues::getInstanceRequire('id_persona', $row, 'ip_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'dom_');
    return $row_;
  }



}
