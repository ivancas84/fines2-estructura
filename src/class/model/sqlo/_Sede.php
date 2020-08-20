<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _SedeSqlo extends EntitySqlo {

  public $entityName = "sede";

  protected function _insert(array $row){ //@override
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

  protected function _update(array $row){ //@override
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
    $row_ = EntityValues::getInstanceRequire($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'dom_')->_toArray();
    if(!is_null($row['ts_id'])) $row_["tipo_sede_"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'ts_')->_toArray();
    if(!is_null($row['ce_id'])) $row_["centro_educativo_"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'ce_')->_toArray();
    if(!is_null($row['ce_dom_id'])) $row_["centro_educativo_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'ce_dom_')->_toArray();
    if(!is_null($row['coo_id'])) $row_["coordinador_"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'coo_')->_toArray();
    if(!is_null($row['coo_dom_id'])) $row_["coordinador_"]["domicilio_"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'coo_dom_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["sede"] = EntityValues::getInstanceRequire("sede")->_fromArray($row);
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede')->_fromArray($row, 'ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo')->_fromArray($row, 'ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona')->_fromArray($row, 'coo_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio')->_fromArray($row, 'coo_dom_');
    return $row_;
  }



}
