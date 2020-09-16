<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _ComisionSqlo extends EntitySqlo {

  public $entityName = "comision";

  public function insert(array $row){ //@override
      $sql = "
  INSERT INTO " . $this->entity->sn_() . " (";
      $sql .= "id, " ;
    $sql .= "turno, " ;
    $sql .= "division, " ;
    $sql .= "comentario, " ;
    $sql .= "autorizada, " ;
    $sql .= "apertura, " ;
    $sql .= "publicada, " ;
    $sql .= "observaciones, " ;
    $sql .= "sede, " ;
    $sql .= "modalidad, " ;
    $sql .= "planificacion, " ;
    $sql .= "comision_siguiente, " ;
    $sql .= "calendario, " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ")
VALUES ( ";
    $sql .= $row['id'] . ", " ;
    $sql .= $row['turno'] . ", " ;
    $sql .= $row['division'] . ", " ;
    $sql .= $row['comentario'] . ", " ;
    $sql .= $row['autorizada'] . ", " ;
    $sql .= $row['apertura'] . ", " ;
    $sql .= $row['publicada'] . ", " ;
    $sql .= $row['observaciones'] . ", " ;
    $sql .= $row['sede'] . ", " ;
    $sql .= $row['modalidad'] . ", " ;
    $sql .= $row['planificacion'] . ", " ;
    $sql .= $row['comision_siguiente'] . ", " ;
    $sql .= $row['calendario'] . ", " ;
    $sql = substr($sql, 0, -2); //eliminar ultima coma

    $sql .= ");
";

    return $sql;
  }

  public function _update(array $row){ //@override
    $sql = "
UPDATE " . $this->entity->sn_() . " SET
";
    if (isset($row['turno'] )) $sql .= "turno = " . $row['turno'] . " ," ;
    if (isset($row['division'] )) $sql .= "division = " . $row['division'] . " ," ;
    if (isset($row['comentario'] )) $sql .= "comentario = " . $row['comentario'] . " ," ;
    if (isset($row['autorizada'] )) $sql .= "autorizada = " . $row['autorizada'] . " ," ;
    if (isset($row['apertura'] )) $sql .= "apertura = " . $row['apertura'] . " ," ;
    if (isset($row['publicada'] )) $sql .= "publicada = " . $row['publicada'] . " ," ;
    if (isset($row['observaciones'] )) $sql .= "observaciones = " . $row['observaciones'] . " ," ;
    if (isset($row['sede'] )) $sql .= "sede = " . $row['sede'] . " ," ;
    if (isset($row['modalidad'] )) $sql .= "modalidad = " . $row['modalidad'] . " ," ;
    if (isset($row['planificacion'] )) $sql .= "planificacion = " . $row['planificacion'] . " ," ;
    if (isset($row['comision_siguiente'] )) $sql .= "comision_siguiente = " . $row['comision_siguiente'] . " ," ;
    if (isset($row['calendario'] )) $sql .= "calendario = " . $row['calendario'] . " ," ;
    //eliminar ultima coma
    $sql = substr($sql, 0, -2);

    return $sql;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entity->getName())->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_id'])) $row_["sede_"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_dom_id'])) $row_["sede_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ts_id'])) $row_["sede_"]["tipo_sede_"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_id'])) $row_["sede_"]["centro_educativo_"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['sed_ce_dom_id'])) $row_["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['moa_id'])) $row_["modalidad_"] = $this->container->getValue('modalidad', 'moa')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['cal_id'])) $row_["calendario_"] = $this->container->getValue('calendario', 'cal')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["comision"] = $this->container->getValue("comision")->_fromArray($row, "set");
    $row_["sede"] = $this->container->getValue('sede', 'sed')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'sed_dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'sed_ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'sed_ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'sed_ce_dom')->_fromArray($row, "set");
    $row_["modalidad"] = $this->container->getValue('modalidad', 'moa')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set");
    $row_["calendario"] = $this->container->getValue('calendario', 'cal')->_fromArray($row, "set");
    return $row_;
  }



}
