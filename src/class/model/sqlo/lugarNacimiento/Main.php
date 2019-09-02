<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class LugarNacimientoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('lugar_nacimiento');
    $this->sql = EntitySql::getInstanceRequire('lugar_nacimiento');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "ciudad, " ;
    $sql .= "provincia, " ;
    $sql .= "pais, " ;
    $sql .= "alta, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['ciudad'] . ", " ;
    $sql .= $row['provincia'] . ", " ;
    $sql .= $row['pais'] . ", " ;
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
    if (isset($row['ciudad'] )) $sql .= "ciudad = " . $row['ciudad'] . " ," ;
    if (isset($row['provincia'] )) $sql .= "provincia = " . $row['provincia'] . " ," ;
    if (isset($row['pais'] )) $sql .= "pais = " . $row['pais'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }



}
