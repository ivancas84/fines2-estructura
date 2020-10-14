<?php
require_once("class/model/Rel.php");

class _ContralorRel extends EntityRel{

  public function join(Render $render){
    return $this->container->getSql('planilla_docente', 'pd')->_join('planilla_docente', 'cont', $render) . '
' ;
  }

  public function json(array $row = null){
    if(empty($row)) return null;
    $row_ = $this->container->getValue($this->entityName)->_fromArray($row, "set")->_toArray("json");
    if(!is_null($row['pd_id'])) $row_["planilla_docente_"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set")->_toArray("json");
    return $row_;
  }

  public function value(array $row){
    $row_ = [];
    $row_["contralor"] = $this->container->getValue("contralor")->_fromArray($row, "set");
    $row_["planilla_docente"] = $this->container->getValue('planilla_docente', 'pd')->_fromArray($row, "set");
    return $row_;
  }



}
