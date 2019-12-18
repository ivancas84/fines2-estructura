<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class ComisionSqloMain extends EntitySqlo {

  public function __construct(){
    /**
     * Se definen todos los recursos de forma independiente, sin parametros en el constructor, para facilitar el polimorfismo de las subclases
     */
    $this->db = Dba::dbInstance();
    $this->entity = Entity::getInstanceRequire('comision');
    $this->sql = EntitySql::getInstanceRequire('comision');
  }

  protected function _insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "turno, " ;
    $sql .= "division, " ;
    $sql .= "anio, " ;
    $sql .= "semestre, " ;
    $sql .= "comentario, " ;
    $sql .= "autorizada, " ;
    $sql .= "apertura, " ;
    $sql .= "publicada, " ;
    $sql .= "fecha_anio, " ;
    $sql .= "fecha_semestre, " ;
    $sql .= "observaciones, " ;
    $sql .= "alta, " ;
    $sql .= "sede, " ;
    $sql .= "plan, " ;
    $sql .= "modalidad, " ;
    $sql .= "comision_siguiente, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['turno'] . ", " ;
    $sql .= $row['division'] . ", " ;
    $sql .= $row['anio'] . ", " ;
    $sql .= $row['semestre'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['autorizada'] . ", " ;
    $sql .= $row['apertura'] . ", " ;
    $sql .= $row['publicada'] . ", " ;
    $sql .= $row['fecha_anio'] . ", " ;
    $sql .= $row['fecha_semestre'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['alta'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql .= $row['plan'] . ", " ;
    $sql .= $row['modalidad'] . ", " ;
    $sql .= $row['comision_siguiente'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  protected function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['turno'] )) $sql .= "turno = " . $row['turno'] . " ," ;
    if (isset($row['division'] )) $sql .= "division = " . $row['division'] . " ," ;
    if (isset($row['anio'] )) $sql .= "anio = " . $row['anio'] . " ," ;
    if (isset($row['semestre'] )) $sql .= "semestre = " . $row['semestre'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['autorizada'] )) $sql .= "autorizada = " . $row['autorizada'] . " ," ;
    if (isset($row['apertura'] )) $sql .= "apertura = " . $row['apertura'] . " ," ;
    if (isset($row['publicada'] )) $sql .= "publicada = " . $row['publicada'] . " ," ;
    if (isset($row['fecha_anio'] )) $sql .= "fecha_anio = " . $row['fecha_anio'] . " ," ;
    if (isset($row['fecha_semestre'] )) $sql .= "fecha_semestre = " . $row['fecha_semestre'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['alta'] )) $sql .= "alta = " . $row['alta'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    if (isset($row['plan'] )) $sql .= "plan = " . $row['plan'] . " ," ;
    if (isset($row['modalidad'] )) $sql .= "modalidad = " . $row['modalidad'] . " ," ;
    if (isset($row['comision_siguiente'] )) $sql .= "comision_siguiente = " . $row['comision_siguiente'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row){
    if(empty($row)) return null;
    $row_ = $this->sql->_json($row);
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
    if(!is_null($row['pla_id'])){
      $json = EntitySql::getInstanceRequire('plan', 'pla')->_json($row);
      $row_["plan_"] = $json;
    }
    if(!is_null($row['moa_id'])){
      $json = EntitySql::getInstanceRequire('modalidad', 'moa')->_json($row);
      $row_["modalidad_"] = $json;
    }
    return $row_;
  }

  public function values(array $row){
    $row_ = [];

    $row_["comision"] = EntityValues::getInstanceRequire("comision", $row);
    $row_["sede"] = EntityValues::getInstanceRequire('sede', $row, 'sed_');
    $row_["domicilio"] = EntityValues::getInstanceRequire('domicilio', $row, 'sed_dom_');
    $row_["tipo_sede"] = EntityValues::getInstanceRequire('tipo_sede', $row, 'sed_ts_');
    $row_["centro_educativo"] = EntityValues::getInstanceRequire('centro_educativo', $row, 'sed_ce_');
    $row_["domicilio1"] = EntityValues::getInstanceRequire('domicilio', $row, 'sed_ce_dom_');
    $row_["plan"] = EntityValues::getInstanceRequire('plan', $row, 'pla_');
    $row_["modalidad"] = EntityValues::getInstanceRequire('modalidad', $row, 'moa_');
    return $row_;
  }



}
