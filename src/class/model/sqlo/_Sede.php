<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _SedeSqlo extends EntitySqlo {

  public $entityName = "sede";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "numero, " ;
    $sql .= "nombre, " ;
    $sql .= "observaciones, " ;
    $sql .= "baja, " ;
    $sql .= "domicilio, " ;
    $sql .= "tipo_sede, " ;
    $sql .= "centro_educativo, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['numero'] . ", " ;
    $sql .= $row['nombre'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['domicilio'] . ", " ;
    $sql .= $row['tipo_sede'] . ", " ;
    $sql .= $row['centro_educativo'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['numero'] )) $sql .= "numero = " . $row['numero'] . " ," ;
    if (isset($row['nombre'] )) $sql .= "nombre = " . $row['nombre'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['domicilio'] )) $sql .= "domicilio = " . $row['domicilio'] . " ," ;
    if (isset($row['tipo_sede'] )) $sql .= "tipo_sede = " . $row['tipo_sede'] . " ," ;
    if (isset($row['centro_educativo'] )) $sql .= "centro_educativo = " . $row['centro_educativo'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ts_id'])) $row_["tipo_sede_"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_id'])) $row_["centro_educativo_"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_dom_id'])) $row_["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["sede"] = $this->container->getValue("sede")->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set");
    return $row_;
  }



}
