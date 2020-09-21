<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _ContralorSqlo extends EntitySqlo {

  public $entityName = "contralor";

  public function insert(array $row){ //@override
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

  public function _update(array $row){ //@override
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
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["contralor"] = $this->container->getValue("contralor")->_fromArray($row, "set");
    $row_["planilla_docente"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set");
    return $row_;
  }



}
