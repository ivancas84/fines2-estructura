<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _AsignaturaSqlo extends EntitySqlo {

  public $entityName = "asignatura";

  public function insert(array $row){ //@override
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

  public function _update(array $row){ //@override
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
