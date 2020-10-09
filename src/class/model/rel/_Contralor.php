<?php
require_once("class/model/Rel.php");

class _ContralorRel extends EntityRel{

  public function mapping($field){
    if($f = $this->container->getMapping($this->entityName)->_eval($field)) return $f;
    if($f = $this->container->getMapping('planilla_docente', 'pd')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entityName}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entityName)->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planilla_docente', 'pd')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('planilla_docente', 'pd')->_join('planilla_docente', 'cont', $render) . '
' ;
  }

  public function condition($field, $option, $value) {
    if($c = $this->container->getCondition($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planilla_docente','pd')->_eval($field, [$option, $value])) return $c;
  }

  public function conditionAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entityName)->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planilla_docente','pd')->_eval($field, [$option, $value])) return $c;
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
