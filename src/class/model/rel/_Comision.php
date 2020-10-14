<?php
require_once("class/model/Rel.php");

class _ComisionRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('sede', 'sed')->_join('sede', 'comi', $render) . '
' . $this->container->getSql('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . $this->container->getSql('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . $this->container->getSql('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'moa')->_join('modalidad', 'comi', $render) . '
' . $this->container->getSql('planificacion', 'pla')->_join('planificacion', 'comi', $render) . '
' . $this->container->getSql('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' . $this->container->getSql('calendario', 'cal')->_join('calendario', 'comi', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
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

  public function value(array $row){
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
