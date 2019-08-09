<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class UsuarioSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('usuario');
    $this->sql = EntitySql::getInstanceFromString('usuario');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "clave, " ;
    $sql .= "alta, " ;
    $sql .= "baja, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['clave'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['baja'] . ", " ;
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
    if (isset($row['clave'] )) $sql .= "clave = " . $row['clave'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceFromString('id_persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["usuario"] = EntityValues::getInstanceFromString("usuario", $json);

    $json = ($row && !is_null($row['per_id'])) ? EntitySql::getInstanceFromString('id_persona', 'per')->_json($row) : null;
    $row_["persona"] = EntityValues::getInstanceFromString('id_persona', $json);

    return $row_;
  }



}
