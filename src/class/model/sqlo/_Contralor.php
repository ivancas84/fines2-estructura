<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _ContralorSqlo extends EntitySqlo {

  public $entityName = "contralor";

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "fecha_contralor, " ;
    $sql .= "fecha_consejo, " ;
    $sql .= "insertado, " ;
    $sql .= "planilla_docente, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['fecha_contralor'] . ", " ;
    $sql .= $row['fecha_consejo'] . ", " ;
    $sql .= $row['insertado'] . ", " ;
    $sql .= $row['planilla_docente'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['fecha_contralor'] )) $sql .= "fecha_contralor = " . $row['fecha_contralor'] . " ," ;
    if (isset($row['fecha_consejo'] )) $sql .= "fecha_consejo = " . $row['fecha_consejo'] . " ," ;
    if (isset($row['insertado'] )) $sql .= "insertado = " . $row['insertado'] . " ," ;
    if (isset($row['planilla_docente'] )) $sql .= "planilla_docente = " . $row['planilla_docente'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = EntityValues::getInstanceRequire('planilla_docente')->_fromArray($row, 'pd_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["contralor"] = EntityValues::getInstanceRequire("contralor")->_fromArray($row);
    $row_["planilla_docente"] = EntityValues::getInstanceRequire('planilla_docente')->_fromArray($row, 'pd_');
    return $row_;
  }



}
