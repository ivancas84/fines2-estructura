<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class CursoSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('curso');
    $this->sql = EntitySql::getInstanceRequire('curso');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "horas_catedra, " ;
    $sql .= "alta, " ;
    $sql .= "comision, " ;
    $sql .= "asignatura, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['horas_catedra'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['comision'] . ", " ;
    $sql .= $row['asignatura'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['horas_catedra'] )) $sql .= "horas_catedra = " . $row['horas_catedra'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['comision'] )) $sql .= "comision = " . $row['comision'] . " ," ;
    if (isset($row['asignatura'] )) $sql .= "asignatura = " . $row['asignatura'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
    if(!is_null($row['com_id'])){
      $json = EntitySql::getInstanceRequire('comision', 'com')->_json($row);
      $row_["comision_"] = $json;
    }
    if(!is_null($row['com_sed_id'])){
      $json = EntitySql::getInstanceRequire('sede', 'com_sed')->_json($row);
      $row_["comision_"]["sede_"] = $json;
    }
    if(!is_null($row['com_sed_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'com_sed_dom')->_json($row);
      $row_["comision_"]["sede_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_sed_ts_id'])){
      $json = EntitySql::getInstanceRequire('tipo_sede', 'com_sed_ts')->_json($row);
      $row_["comision_"]["sede_"]["tipo_sede_"] = $json;
    }
    if(!is_null($row['com_sed_ce_id'])){
      $json = EntitySql::getInstanceRequire('centro_educativo', 'com_sed_ce')->_json($row);
      $row_["comision_"]["sede_"]["centro_educativo_"] = $json;
    }
    if(!is_null($row['com_sed_ce_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'com_sed_ce_dom')->_json($row);
      $row_["comision_"]["sede_"]["centro_educativo_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_sed_coo_id'])){
      $json = EntitySql::getInstanceRequire('persona', 'com_sed_coo')->_json($row);
      $row_["comision_"]["sede_"]["coordinador_"] = $json;
    }
    if(!is_null($row['com_sed_coo_dom_id'])){
      $json = EntitySql::getInstanceRequire('domicilio', 'com_sed_coo_dom')->_json($row);
      $row_["comision_"]["sede_"]["coordinador_"]["domicilio_"] = $json;
    }
    if(!is_null($row['com_pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'com_pla')->_json($row);
      $row_["comision_"]["plan_"] = $json;
    }
    if(!is_null($row['com_moa_id'])){
      $json = EntitySql::getInstanceRequire('modalidad', 'com_moa')->_json($row);
      $row_["comision_"]["modalidad_"] = $json;
    }
    if(!is_null($row['asi_id'])){
      $json = EntitySql::getInstanceRequire('asignatura', 'asi')->_json($row);
      $row_["asignatura_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["curso"] = EntityValues::getInstanceRequire("curso", $row);
    $row_["comision"] = EntityValues::getInstanceRequire('comision', $row, 'com_');
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'com_sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'com_sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'com_sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'com_sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'com_sed_ce_dom_');
    $row_["coordinador"] = EntityValues::getInstanceRequire('persona', $row, 'com_sed_coo_');
    $row_["domicilio2"] = EntityValues::getInstanceRequire('domicilio', $row, 'com_sed_coo_dom_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'com_pla_');
    $row_["modalidad"] = EntityValues::getInstanceRequire('modalidad', $row, 'com_moa_');
    $row_["asignatura"] = EntityValues::getInstanceRequire('asignatura', $row, 'asi_');
    return $row_;
  }



}
