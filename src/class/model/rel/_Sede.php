<?php
require_once("class/model/Rel.php");

class _SedeRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('domicilio', 'dom')->_join('domicilio', 'sede', $render) . '
' . $this->container->getSql('tipo_sede', 'ts')->_join('tipo_sede', 'sede', $render) . '
' . $this->container->getSql('centro_educativo', 'ce')->_join('centro_educativo', 'sede', $render) . '
' . $this->container->getSql('domicilio', 'ce_dom')->_join('domicilio', 'ce', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ts_id'])) $row_["tipo_sede_"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_id'])) $row_["centro_educativo_"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['ce_dom_id'])) $row_["centro_educativo_"]["domicilio_"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["sede"] = $this->container->getValue("sede")->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set");
    $row_["tipo_sede"] = $this->container->getValue('tipo_sede', 'ts')->_fromArray($row, "set");
    $row_["centro_educativo"] = $this->container->getValue('centro_educativo', 'ce')->_fromArray($row, "set");
    $row_["domicilio1"] = $this->container->getValue('domicilio', 'ce_dom')->_fromArray($row, "set");
    return $row_;
  }



}
