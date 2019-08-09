<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class AsignaturaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('asignatura');
    $this->sql = EntitySql::getInstanceFromString('asignatura');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "nombre, " ;
    $sql .= "formacion, " ;
    $sql .= "clasificacion, " ;
    $sql .= "codigo, " ;
    $sql .= "perfil, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['formacion'] . ", " ;
    $sql .= $row['clasificacion'] . ", " ;
    $sql .= $row['codigo'] . ", " ;
    $sql .= $row['perfil'] . ", " ;
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
    if (isset($row['formacion'] )) $sql .= "formacion = " . $row['formacion'] . " ," ;
    if (isset($row['clasificacion'] )) $sql .= "clasificacion = " . $row['clasificacion'] . " ," ;
    if (isset($row['codigo'] )) $sql .= "codigo = " . $row['codigo'] . " ," ;
    if (isset($row['perfil'] )) $sql .= "perfil = " . $row['perfil'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
