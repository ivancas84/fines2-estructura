<?php
require_once("class/model/Rel.php");

class _CentroEducativoRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('domicilio', 'dom')->_join('domicilio', 'ce', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['dom_id'])) $row_["domicilio_"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["centro_educativo"] = $this->container->getValue("centro_educativo")->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'dom')->_fromArray($row, "set");
    return $row_;
  }



}
