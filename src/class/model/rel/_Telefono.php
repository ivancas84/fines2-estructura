<?php
require_once("class/model/Rel.php");

class _TelefonoRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('persona', 'per')->_join('persona', 'tele', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_id'])) $row_["persona_"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['per_dom_id'])) $row_["persona_"]["domicilio_"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["telefono"] = $this->container->getValue("telefono")->_fromArray($row, "set");
    $row_["persona"] = $this->container->getValue('persona', 'per')->_fromArray($row, "set");
    $row_["domicilio"] = $this->container->getValue('domicilio', 'per_dom')->_fromArray($row, "set");
    return $row_;
  }



}
