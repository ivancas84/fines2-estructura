<?php
require_once("class/model/Rel.php");

class _DistribucionHorariaRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('asignatura', 'asi')->_join('asignatura', 'dh', $render) . '
' . $this->container->getSql('planificacion', 'pla')->_join('planificacion', 'dh', $render) . '
' . $this->container->getSql('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['asi_id'])) $row_["asignatura_"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_id'])) $row_["planificacion_"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pla_plb_id'])) $row_["planificacion_"]["plan_"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["distribucion_horaria"] = $this->container->getValue("distribucion_horaria")->_fromArray($row, "set");
    $row_["asignatura"] = $this->container->getValue('asignatura', 'asi')->_fromArray($row, "set");
    $row_["planificacion"] = $this->container->getValue('planificacion', 'pla')->_fromArray($row, "set");
    $row_["plan"] = $this->container->getValue('plan', 'pla_plb')->_fromArray($row, "set");
    return $row_;
  }



}
