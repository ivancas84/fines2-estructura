<?php
require_once("class/model/Sql.php");

class _HorarioSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('curso', 'cur')->_eval($field)) return $f;
    if($f = $this->container->getMapping('comision', 'cur_com')->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'cur_com_sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'cur_com_sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'cur_com_sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'cur_com_sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'cur_com_sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('modalidad', 'cur_com_moa')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'cur_com_pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'cur_com_pla_plb')->_eval($field)) return $f;
    if($f = $this->container->getMapping('calendario', 'cur_com_cal')->_eval($field)) return $f;
    if($f = $this->container->getMapping('asignatura', 'cur_asi')->_eval($field)) return $f;
    if($f = $this->container->getMapping('dia', 'dia')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('curso', 'cur')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('comision', 'cur_com')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('sede', 'cur_com_sed')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'cur_com_sed_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'cur_com_sed_ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'cur_com_sed_ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'cur_com_sed_ce_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('modalidad', 'cur_com_moa')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planificacion', 'cur_com_pla')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'cur_com_pla_plb')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('calendario', 'cur_com_cal')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('asignatura', 'cur_asi')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('dia', 'dia')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('curso', 'cur')->_join('curso', 'hora', $render) . '
' . $this->container->getSql('comision', 'cur_com')->_join('comision', 'cur', $render) . '
' . $this->container->getSql('sede', 'cur_com_sed')->_join('sede', 'cur_com', $render) . '
' . $this->container->getSql('domicilio', 'cur_com_sed_dom')->_join('domicilio', 'cur_com_sed', $render) . '
' . $this->container->getSql('tipo_sede', 'cur_com_sed_ts')->_join('tipo_sede', 'cur_com_sed', $render) . '
' . $this->container->getSql('centro_educativo', 'cur_com_sed_ce')->_join('centro_educativo', 'cur_com_sed', $render) . '
' . $this->container->getSql('domicilio', 'cur_com_sed_ce_dom')->_join('domicilio', 'cur_com_sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'cur_com_moa')->_join('modalidad', 'cur_com', $render) . '
' . $this->container->getSql('planificacion', 'cur_com_pla')->_join('planificacion', 'cur_com', $render) . '
' . $this->container->getSql('plan', 'cur_com_pla_plb')->_join('plan', 'cur_com_pla', $render) . '
' . $this->container->getSql('calendario', 'cur_com_cal')->_join('calendario', 'cur_com', $render) . '
' . $this->container->getSql('asignatura', 'cur_asi')->_join('asignatura', 'cur', $render) . '
' . $this->container->getSql('dia', 'dia')->_join('dia', 'hora', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('curso','cur')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('comision','cur_com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('sede','cur_com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','cur_com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','cur_com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','cur_com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','cur_com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('modalidad','cur_com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planificacion','cur_com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','cur_com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('calendario','cur_com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('asignatura','cur_asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('dia','dia')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('curso','cur')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('comision','cur_com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('sede','cur_com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','cur_com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','cur_com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','cur_com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','cur_com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('modalidad','cur_com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planificacion','cur_com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','cur_com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('calendario','cur_com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('asignatura','cur_asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('dia','dia')->_eval($field, [$option, $value])) return $c;
  }



}
