<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _CalendarioSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('calendario');
    $this->sql = EntitySql::getInstanceRequire('calendario');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "inicio, " ;
    $sql .= "fin, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "insertado, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['inicio'] . ", " ;
    $sql .= $row['fin'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['insertado'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['inicio'] )) $sql .= "inicio = " . $row['inicio'] . " ," ;
    if (isset($row['fin'] )) $sql .= "fin = " . $row['fin'] . " ," ;
    if (isset($row['anio'] )) $sql .= "anio = " . $row['anio'] . " ," ;
    if (isset($row['semestre'] )) $sql .= "semestre = " . $row['semestre'] . " ," ;
    if (isset($row['insertado'] )) $sql .= "insertado = " . $row['insertado'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
