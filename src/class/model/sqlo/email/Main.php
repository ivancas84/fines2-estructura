<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class EmailSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('email');
    $this->sql = EntitySql::getInstanceRequire('email');
  }

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

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    if(!is_null($row['per_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'per_dom')->_json($row);
      $row_["persona_"]["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["email"] = EntityValues::getInstanceRequire("email", $row);
    $row_["persona"] = EntityValues::getInstanceRequire('persona', $row, 'per_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'per_dom_');
    return $row_;
  }



}
