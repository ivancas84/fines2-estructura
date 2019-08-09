<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class IdPersonaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('id_persona');
    $this->sql = EntitySql::getInstanceFromString('id_persona');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "nombres, " ;
    $sql .= "apellidos, " ;
    $sql .= "sobrenombre, " ;
    $sql .= "fecha_nacimiento, " ;
    $sql .= "tipo_documento, " ;
    $sql .= "numero_documento, " ;
    $sql .= "email, " ;
    $sql .= "genero, " ;
    $sql .= "cuil, " ;
    $sql .= "alta, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombres'] . ", " ;
    $sql .= $row['apellidos'] . ", " ;
    $sql .= $row['sobrenombre'] . ", " ;
    $sql .= $row['fecha_nacimiento'] . ", " ;
    $sql .= $row['tipo_documento'] . ", " ;
    $sql .= $row['numero_documento'] . ", " ;
    $sql .= $row['email'] . ", " ;
    $sql .= $row['genero'] . ", " ;
    $sql .= $row['cuil'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['nombres'] )) $sql .= "nombres = " . $row['nombres'] . " ," ;
    if (isset($row['apellidos'] )) $sql .= "apellidos = " . $row['apellidos'] . " ," ;
    if (isset($row['sobrenombre'] )) $sql .= "sobrenombre = " . $row['sobrenombre'] . " ," ;
    if (isset($row['fecha_nacimiento'] )) $sql .= "fecha_nacimiento = " . $row['fecha_nacimiento'] . " ," ;
    if (isset($row['tipo_documento'] )) $sql .= "tipo_documento = " . $row['tipo_documento'] . " ," ;
    if (isset($row['numero_documento'] )) $sql .= "numero_documento = " . $row['numero_documento'] . " ," ;
    if (isset($row['email'] )) $sql .= "email = " . $row['email'] . " ," ;
    if (isset($row['genero'] )) $sql .= "genero = " . $row['genero'] . " ," ;
    if (isset($row['cuil'] )) $sql .= "cuil = " . $row['cuil'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["id_persona"] = EntityValues::getInstanceFromString("id_persona", $json);

    return $row_;
  }



}
