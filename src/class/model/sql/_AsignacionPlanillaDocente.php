<?php
require_once("class/model/Sql.php");

class _AsignacionPlanillaDocenteSql extends EntitySql{

  public function mappingField($field){
    if($f = $this->container->getMapping($this->entity->getName())->_eval($field)) return $f;
    if($f = $this->container->getMapping('planilla_docente', 'pd')->_eval($field)) return $f;
    if($f = $this->container->getMapping('toma', 'tom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('curso', 'tom_cur')->_eval($field)) return $f;
    if($f = $this->container->getMapping('comision', 'tom_cur_com')->_eval($field)) return $f;
    if($f = $this->container->getMapping('sede', 'tom_cur_com_sed')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'tom_cur_com_sed_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('tipo_sede', 'tom_cur_com_sed_ts')->_eval($field)) return $f;
    if($f = $this->container->getMapping('centro_educativo', 'tom_cur_com_sed_ce')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'tom_cur_com_sed_ce_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('modalidad', 'tom_cur_com_moa')->_eval($field)) return $f;
    if($f = $this->container->getMapping('planificacion', 'tom_cur_com_pla')->_eval($field)) return $f;
    if($f = $this->container->getMapping('plan', 'tom_cur_com_pla_plb')->_eval($field)) return $f;
    if($f = $this->container->getMapping('calendario', 'tom_cur_com_cal')->_eval($field)) return $f;
    if($f = $this->container->getMapping('asignatura', 'tom_cur_asi')->_eval($field)) return $f;
    if($f = $this->container->getMapping('persona', 'tom_doc')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'tom_doc_dom')->_eval($field)) return $f;
    if($f = $this->container->getMapping('persona', 'tom_ree')->_eval($field)) return $f;
    if($f = $this->container->getMapping('domicilio', 'tom_ree_dom')->_eval($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function fields(){
    return implode(",", $this->container->getFieldAlias($this->entity->getName())->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planilla_docente', 'pd')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('toma', 'tom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('curso', 'tom_cur')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('comision', 'tom_cur_com')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('sede', 'tom_cur_com_sed')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'tom_cur_com_sed_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('tipo_sede', 'tom_cur_com_sed_ts')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('centro_educativo', 'tom_cur_com_sed_ce')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'tom_cur_com_sed_ce_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('modalidad', 'tom_cur_com_moa')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('planificacion', 'tom_cur_com_pla')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('plan', 'tom_cur_com_pla_plb')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('calendario', 'tom_cur_com_cal')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('asignatura', 'tom_cur_asi')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('persona', 'tom_doc')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'tom_doc_dom')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('persona', 'tom_ree')->_toArray()) . ',
' . implode(",", $this->container->getFieldAlias('domicilio', 'tom_ree_dom')->_toArray()) . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('planilla_docente', 'pd')->_join('planilla_docente', 'apd', $render) . '
' . $this->container->getSql('toma', 'tom')->_join('toma', 'apd', $render) . '
' . $this->container->getSql('curso', 'tom_cur')->_join('curso', 'tom', $render) . '
' . $this->container->getSql('comision', 'tom_cur_com')->_join('comision', 'tom_cur', $render) . '
' . $this->container->getSql('sede', 'tom_cur_com_sed')->_join('sede', 'tom_cur_com', $render) . '
' . $this->container->getSql('domicilio', 'tom_cur_com_sed_dom')->_join('domicilio', 'tom_cur_com_sed', $render) . '
' . $this->container->getSql('tipo_sede', 'tom_cur_com_sed_ts')->_join('tipo_sede', 'tom_cur_com_sed', $render) . '
' . $this->container->getSql('centro_educativo', 'tom_cur_com_sed_ce')->_join('centro_educativo', 'tom_cur_com_sed', $render) . '
' . $this->container->getSql('domicilio', 'tom_cur_com_sed_ce_dom')->_join('domicilio', 'tom_cur_com_sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'tom_cur_com_moa')->_join('modalidad', 'tom_cur_com', $render) . '
' . $this->container->getSql('planificacion', 'tom_cur_com_pla')->_join('planificacion', 'tom_cur_com', $render) . '
' . $this->container->getSql('plan', 'tom_cur_com_pla_plb')->_join('plan', 'tom_cur_com_pla', $render) . '
' . $this->container->getSql('calendario', 'tom_cur_com_cal')->_join('calendario', 'tom_cur_com', $render) . '
' . $this->container->getSql('asignatura', 'tom_cur_asi')->_join('asignatura', 'tom_cur', $render) . '
' . $this->container->getSql('persona', 'tom_doc')->_join('docente', 'tom', $render) . '
' . $this->container->getSql('domicilio', 'tom_doc_dom')->_join('domicilio', 'tom_doc', $render) . '
' . $this->container->getSql('persona', 'tom_ree')->_join('reemplazo', 'tom', $render) . '
' . $this->container->getSql('domicilio', 'tom_ree_dom')->_join('domicilio', 'tom_ree', $render) . '
' ;
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->container->getCondition($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planilla_docente','pd')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('toma','tom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('curso','tom_cur')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('comision','tom_cur_com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('sede','tom_cur_com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','tom_cur_com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('tipo_sede','tom_cur_com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('centro_educativo','tom_cur_com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','tom_cur_com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('modalidad','tom_cur_com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('planificacion','tom_cur_com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('plan','tom_cur_com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('calendario','tom_cur_com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('asignatura','tom_cur_asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('persona','tom_doc')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','tom_doc_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('persona','tom_ree')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getCondition('domicilio','tom_ree_dom')->_eval($field, [$option, $value])) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->container->getConditionAux($this->entity->getName())->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planilla_docente','pd')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('toma','tom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('curso','tom_cur')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('comision','tom_cur_com')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('sede','tom_cur_com_sed')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','tom_cur_com_sed_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('tipo_sede','tom_cur_com_sed_ts')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('centro_educativo','tom_cur_com_sed_ce')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','tom_cur_com_sed_ce_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('modalidad','tom_cur_com_moa')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('planificacion','tom_cur_com_pla')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('plan','tom_cur_com_pla_plb')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('calendario','tom_cur_com_cal')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('asignatura','tom_cur_asi')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('persona','tom_doc')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','tom_doc_dom')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('persona','tom_ree')->_eval($field, [$option, $value])) return $c;
    if($c = $this->container->getConditionAux('domicilio','tom_ree_dom')->_eval($field, [$option, $value])) return $c;
  }



}
