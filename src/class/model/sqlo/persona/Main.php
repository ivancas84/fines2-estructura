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
    $sql .= "nombres, " ;
    $sql .= "apellidos, " ;
    $sql .= "apodo, " ;
    $sql .= "numero_documento, " ;
    $sql .= "cuil, " ;
    $sql .= "email, " ;
    $sql .= "genero, " ;
    $sql .= "alta, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombres'] . ", " ;
    $sql .= $row['apellidos'] . ", " ;
    $sql .= $row['apodo'] . ", " ;
    $sql .= $row['numero_documento'] . ", " ;
    $sql .= $row['cuil'] . ", " ;
    $sql .= $row['email'] . ", " ;
    $sql .= $row['genero'] . ", " ;
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
    if (isset($row['apodo'] )) $sql .= "apodo = " . $row['apodo'] . " ," ;
    if (isset($row['numero_documento'] )) $sql .= "numero_documento = " . $row['numero_documento'] . " ," ;
    if (isset($row['cuil'] )) $sql .= "cuil = " . $row['cuil'] . " ," ;
    if (isset($row['email'] )) $sql .= "email = " . $row['email'] . " ," ;
    if (isset($row['genero'] )) $sql .= "genero = " . $row['genero'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
