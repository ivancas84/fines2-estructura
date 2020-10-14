<?php
require_once("class/model/Rel.php");

class _PlanificacionRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('plan', 'plb')->_join('plan', 'pla', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['plb_id'])) $row_["plan_"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["planificacion"] = $this->container->getValue("planificacion")->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'plb')->_fromArray($row, "set");
    return $row_;
  }



}
