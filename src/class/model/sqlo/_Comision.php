<?php

require_once("class/model/Sqlo.php");
require_once("class/model/Sql.php");
require_once("class/model/Entity.php");
require_once("class/model/Values.php");

class _ComisionSqlo extends EntitySqlo {

  public $entityName = "comision";

  protected function _insert(array $row){ //@override
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

  protected function _update(array $row){ //@override
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
    $row_ = $this->container->getValues($this->entity->getName())->_fromArray($row)->_toArray();
    if(!is_null($row['sed_id'])) $row_["sede_"] = $this->container->getValues('sede')->_fromArray($row, 'sed_')->_toArray();
    if(!is_null($row['sed_dom_id'])) $row_["sede_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'sed_dom_')->_toArray();
    if(!is_null($row['sed_ts_id'])) $row_["sede_"]["tipo_sede_"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'sed_ts_')->_toArray();
    if(!is_null($row['sed_ce_id'])) $row_["sede_"]["centro_educativo_"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'sed_ce_')->_toArray();
    if(!is_null($row['sed_ce_dom_id'])) $row_["sede_"]["centro_educativo_"]["domicilio_"] = $this->container->getValues('domicilio')->_fromArray($row, 'sed_ce_dom_')->_toArray();
    if(!is_null($row['moa_id'])) $row_["modalidad_"] = $this->container->getValues('modalidad')->_fromArray($row, 'moa_')->_toArray();
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValues('planificacion')->_fromArray($row, 'pla_')->_toArray();
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValues('plan')->_fromArray($row, 'pla_plb_')->_toArray();
    if(!is_null($row['cal_id'])) $row_["calendario_"] = $this->container->getValues('calendario')->_fromArray($row, 'cal_')->_toArray();
    return $row_;
  }

  public function values(array $row){
    $row_ = [];
    $row_["comision"] = $this->container->getValues("comision")->_fromArray($row);
    $row_["sede"] = $this->container->getValues('sede')->_fromArray($row, 'sed_');
    $row_["domicilio"] = $this->container->getValues('domicilio')->_fromArray($row, 'sed_dom_');
    $row_["tipo_sede"] = $this->container->getValues('tipo_sede')->_fromArray($row, 'sed_ts_');
    $row_["centro_educativo"] = $this->container->getValues('centro_educativo')->_fromArray($row, 'sed_ce_');
    $row_["domicilio1"] = $this->container->getValues('domicilio')->_fromArray($row, 'sed_ce_dom_');
    $row_["modalidad"] = $this->container->getValues('modalidad')->_fromArray($row, 'moa_');
    $row_["planificacion"] = $this->container->getValues('planificacion')->_fromArray($row, 'pla_');
    $row_["plan"] = $this->container->getValues('plan')->_fromArray($row, 'pla_plb_');
    $row_["calendario"] = $this->container->getValues('calendario')->_fromArray($row, 'cal_');
    return $row_;
  }



}
