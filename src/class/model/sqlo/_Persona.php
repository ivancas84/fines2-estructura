<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _PersonaSqlo extends EntitySqlo {

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
    $sql .= "fecha_nacimiento, " ;
    $sql .= "numero_documento, " ;
    $sql .= "cuil, " ;
    $sql .= "genero, " ;
    $sql .= "apodo, " ;
    $sql .= "alta, " ;
    $sql .= "domicilio, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombres'] . ", " ;
    $sql .= $row['apellidos'] . ", " ;
    $sql .= $row['fecha_nacimiento'] . ", " ;
    $sql .= $row['numero_documento'] . ", " ;
    $sql .= $row['cuil'] . ", " ;
    $sql .= $row['genero'] . ", " ;
    $sql .= $row['apodo'] . ", " ;
    $sql .= $row['alta'] . ", " ;
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
    if (isset($row['nombres'] )) $sql .= "nombres = " . $row['nombres'] . " ," ;
    if (isset($row['apellidos'] )) $sql .= "apellidos = " . $row['apellidos'] . " ," ;
    if (isset($row['fecha_nacimiento'] )) $sql .= "fecha_nacimiento = " . $row['fecha_nacimiento'] . " ," ;
    if (isset($row['numero_documento'] )) $sql .= "numero_documento = " . $row['numero_documento'] . " ," ;
    if (isset($row['cuil'] )) $sql .= "cuil = " . $row['cuil'] . " ," ;
    if (isset($row['genero'] )) $sql .= "genero = " . $row['genero'] . " ," ;
    if (isset($row['apodo'] )) $sql .= "apodo = " . $row['apodo'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
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

    $row_["persona"] = EntityValues::getInstanceRequire("persona", $row);
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'dom_');
    return $row_;
  }



}
