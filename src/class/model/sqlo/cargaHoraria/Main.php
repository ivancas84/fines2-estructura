<?php

require_once("class/model/Sqlo.php");

//Implementacion principal de Sqlo para una entidad especifica
class CargaHorariaSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceFromString('carga_horaria');
    $this->sql = EntitySql::getInstanceFromString('carga_horaria');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "asignatura, " ;
    $sql .= "plan, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
    $sql .= $row['plan'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['anio'] )) $sql .= "anio = " . $row['anio'] . " ," ;
    if (isset($row['semestre'] )) $sql .= "semestre = " . $row['semestre'] . " ," ;
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['asi_id'])){
      $json = EntitySql::getInstanceFromString('asignatura', 'asi')->_json($row);
      $row_["asignatura_"] = $json;
    }
    if(!is_null($row['pla_id'])){
      $json = EntitySql::getInstanceFromString('plan', 'pla')->_json($row);
      $row_["plan_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $json = ($row && !is_null($row['id'])) ? $this->sql->_json($row) : null;
    $row_["carga_horaria"] = EntityValues::getInstanceFromString("carga_horaria", $json);

    $json = ($row && !is_null($row['asi_id'])) ? EntitySql::getInstanceFromString('asignatura', 'asi')->_json($row) : null;
    $row_["asignatura"] = EntityValues::getInstanceFromString('asignatura', $json);

    $json = ($row && !is_null($row['pla_id'])) ? EntitySql::getInstanceFromString('plan', 'pla')->_json($row) : null;
    $row_["plan"] = EntityValues::getInstanceFromString('plan', $json);

    return $row_;
  }



}
