<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _HorarioSqlo extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('horario');
    $this->sql = EntitySql::getInstanceRequire('horario');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "hora_inicio, " ;
    $sql .= "hora_fin, " ;
    $sql .= "curso, " ;
    $sql .= "dia, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['hora_inicio'] . ", " ;
    $sql .= $row['hora_fin'] . ", " ;
    $sql .= $row['curso'] . ", " ;
    $sql .= $row['dia'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['hora_inicio'] )) $sql .= "hora_inicio = " . $row['hora_inicio'] . " ," ;
    if (isset($row['hora_fin'] )) $sql .= "hora_fin = " . $row['hora_fin'] . " ," ;
    if (isset($row['curso'] )) $sql .= "curso = " . $row['curso'] . " ," ;
    if (isset($row['dia'] )) $sql .= "dia = " . $row['dia'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["horario"] = EntityValues::getInstanceRequire("horario", $row);
    return $row_;
  }



}
