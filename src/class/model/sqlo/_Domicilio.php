<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DomicilioSqlo extends EntitySqlo {

  public $entityName = "domicilio";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "calle, " ;
    $sql .= "entre, " ;
    $sql .= "numero, " ;
    $sql .= "piso, " ;
    $sql .= "departamento, " ;
    $sql .= "barrio, " ;
    $sql .= "localidad, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['calle'] . ", " ;
    $sql .= $row['entre'] . ", " ;
    $sql .= $row['numero'] . ", " ;
    $sql .= $row['piso'] . ", " ;
    $sql .= $row['departamento'] . ", " ;
    $sql .= $row['barrio'] . ", " ;
    $sql .= $row['localidad'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['calle'] )) $sql .= "calle = " . $row['calle'] . " ," ;
    if (isset($row['entre'] )) $sql .= "entre = " . $row['entre'] . " ," ;
    if (isset($row['numero'] )) $sql .= "numero = " . $row['numero'] . " ," ;
    if (isset($row['piso'] )) $sql .= "piso = " . $row['piso'] . " ," ;
    if (isset($row['departamento'] )) $sql .= "departamento = " . $row['departamento'] . " ," ;
    if (isset($row['barrio'] )) $sql .= "barrio = " . $row['barrio'] . " ," ;
    if (isset($row['localidad'] )) $sql .= "localidad = " . $row['localidad'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
