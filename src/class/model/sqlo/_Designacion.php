<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _DesignacionSqlo extends EntitySqlo {

  public $entityName = "designacion";

  protected function _insert(array $row){ //@override
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

  protected function _update(array $row){ //@override
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
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['car_id'])) $row_["cargo_"] = EntityValues::getInstanceRequire('cargo')->_fromArray($row, 'car_')->_toArray();
    if(!is_null($row['sed_id'])) $row_["sede_"] = EntityValues::getInstanceRequire('sede')->_fromArray($row, 'sed_')->_toArray();
    if(!is_null($row['sed_dom_id'])) $row_["sede_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'sed_dom_')->_toArray();
    if(!is_null($row['sed_ts_id'])) $row_["sede_"]["tipo_sede_"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'sed_ts_')->_toArray();
    if(!is_null($row['sed_ce_id'])) $row_["sede_"]["centro_educativo_"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'sed_ce_')->_toArray();
    if(!is_null($row['sed_ce_dom_id'])) $row_["sede_"]["centro_educativo_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'sed_ce_dom_')->_toArray();
    if(!is_null($row['per_id'])) $row_["persona_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_')->_toArray();
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'per_dom_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["designacion"] = EntityValues::getInstanceRequire("designacion")->_fromArray($row);
    $row_["cargo"] = EntityValues::getInstanceRequire('cargo')->_fromArray($row, 'car_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede')->_fromArray($row, 'sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'sed_ce_dom_');
    $row_["persona"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'per_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'per_dom_');
    return $row_;
  }



}
