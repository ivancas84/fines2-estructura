<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DesignacionSqlo extends EntitySqlo {

  public $entityName = "designacion";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "desde, " ;
    $sql .= "hasta, " ;
    $sql .= "alta, " ;
    $sql .= "cargo, " ;
    $sql .= "sede, " ;
    $sql .= "persona, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['desde'] . ", " ;
    $sql .= $row['hasta'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['cargo'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['desde'] )) $sql .= "desde = " . $row['desde'] . " ," ;
    if (isset($row['hasta'] )) $sql .= "hasta = " . $row['hasta'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['cargo'] )) $sql .= "cargo = " . $row['cargo'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['car_id'])) $row_["cargo_"] = $this->container->getValue('cargo', 'car')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_id'])) $row_["sede_"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_dom_id'])) $row_["sede_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ts_id'])) $row_["sede_"]["tipo_sede_"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_id'])) $row_["sede_"]["centro_educativo_"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_dom_id'])) $row_["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_id'])) $row_["persona_"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["designacion"] = $this->container->getValue("designacion")->_fromArray($row, "set");
    $row_["cargo"] = $this->container->getValue('cargo', 'car')->_fromArray($row, "set");
    $row_["sede"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set");
    $row_["persona"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set");
    $row_["domicilio2"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set");
    return $row_;
  }



}
