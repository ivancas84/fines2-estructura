<?php
require_once("class/model/Rel.php");

class _DesignacionRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('cargo', 'car')->_join('cargo', 'desi', $render) . '
' . $this->container->getSql('sede', 'sed')->_join('sede', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . $this->container->getSql('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . $this->container->getSql('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . $this->container->getSql('persona', 'per')->_join('persona', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
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

  public function value(array $row){
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
