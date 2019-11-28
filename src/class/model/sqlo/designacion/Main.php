<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class DesignacionSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('designacion');
    $this->sql = EntitySql::getInstanceRequire('designacion');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "alta, " ;
    $sql .= "baja, " ;
    $sql .= "cargo, " ;
    $sql .= "persona, " ;
    $sql .= "sede, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['baja'] . ", " ;
    $sql .= $row['cargo'] . ", " ;
    $sql .= $row['persona'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['baja'] )) $sql .= "baja = " . $row['baja'] . " ," ;
    if (isset($row['cargo'] )) $sql .= "cargo = " . $row['cargo'] . " ," ;
    if (isset($row['persona'] )) $sql .= "persona = " . $row['persona'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['car_id'])){
      $json = EntitySql::getInstanceRequire('cargo', 'car')->_json($row);
      $row_["cargo_"] = $json;
    }
    if(!is_null($row['per_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'per')->_json($row);
      $row_["persona_"] = $json;
    }
    if(!is_null($row['sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'sed')->_json($row);
      $row_["sede_"] = $json;
    }
    if(!is_null($row['sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_json($row);
      $row_["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_json($row);
      $row_["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['sed_ce_id'])){
      $json = EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_json($row);
      $row_["sede_"]["centro_educativo_"] = $json;
    }
    if(!is_null($row['sed_ce_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_json($row);
      $row_["sede_"]["centro_educativo_"]["domicilio_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["designacion"] = EntityValues::getInstanceRequire("designacion", $row);
    $row_["cargo"] = EntityValues::getInstanceRequire('cargo', $row, 'car_');
    $row_["persona"] = EntityValues::getInstanceRequire('persona', $row, 'per_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'sed_ce_dom_');
    return $row_;
  }



}
