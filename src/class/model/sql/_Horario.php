<?php
require_once("class/model/Sql.php");

class _HorarioSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('horario');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'hora_inicio': return $t.".hora_inicio";
      case $p.'hora_fin': return $t.".hora_fin";
      case $p.'curso': return $t.".curso";
      case $p.'dia': return $t.".dia";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_hora_inicio': return "MIN({$t}.hora_inicio)";
      case $p.'max_hora_inicio': return "MAX({$t}.hora_inicio)";
      case $p.'count_hora_inicio': return "COUNT({$t}.hora_inicio)";

      case $p.'min_hora_fin': return "MIN({$t}.hora_fin)";
      case $p.'max_hora_fin': return "MAX({$t}.hora_fin)";
      case $p.'count_hora_fin': return "COUNT({$t}.hora_fin)";

      case $p.'min_curso': return "MIN({$t}.curso)";
      case $p.'max_curso': return "MAX({$t}.curso)";
      case $p.'count_curso': return "COUNT({$t}.curso)";

      case $p.'min_dia': return "MIN({$t}.dia)";
      case $p.'max_dia': return "MAX({$t}.dia)";
      case $p.'count_dia': return "COUNT({$t}.dia)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('curso', 'cur')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('comision', 'cur_com')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'cur_com_sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'cur_com_sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('centro_educativo', 'cur_com_sed_ce')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_ce_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('modalidad', 'cur_com_moa')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planificacion', 'cur_com_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'cur_com_pla_plb')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('calendario', 'cur_com_cal')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('asignatura', 'cur_asi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('dia', 'dia')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'hora_inicio') . ' AS ' . $p.'hora_inicio, ' . $this->_mappingField($p.'hora_fin') . ' AS ' . $p.'hora_fin, ' . $this->_mappingField($p.'curso') . ' AS ' . $p.'curso, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'hora_inicio') . ', ' . $this->_mappingField($p.'hora_fin') . ', ' . $this->_mappingField($p.'curso') . ', ' . $this->_mappingField($p.'dia') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('curso', 'cur')->_fields() . ',
' . EntitySql::getInstanceRequire('comision', 'cur_com')->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'cur_com_sed')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'cur_com_sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('centro_educativo', 'cur_com_sed_ce')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_ce_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('modalidad', 'cur_com_moa')->_fields() . ',
' . EntitySql::getInstanceRequire('planificacion', 'cur_com_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'cur_com_pla_plb')->_fields() . ',
' . EntitySql::getInstanceRequire('calendario', 'cur_com_cal')->_fields() . ',
' . EntitySql::getInstanceRequire('asignatura', 'cur_asi')->_fields() . ',
' . EntitySql::getInstanceRequire('dia', 'dia')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('curso', 'cur')->_join('curso', 'hora', $render) . '
' . EntitySql::getInstanceRequire('comision', 'cur_com')->_join('comision', 'cur', $render) . '
' . EntitySql::getInstanceRequire('sede', 'cur_com_sed')->_join('sede', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_dom')->_join('domicilio', 'cur_com_sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'cur_com_sed_ts')->_join('tipo_sede', 'cur_com_sed', $render) . '
' . EntitySql::getInstanceRequire('centro_educativo', 'cur_com_sed_ce')->_join('centro_educativo', 'cur_com_sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_sed_ce_dom')->_join('domicilio', 'cur_com_sed_ce', $render) . '
' . EntitySql::getInstanceRequire('modalidad', 'cur_com_moa')->_join('modalidad', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('planificacion', 'cur_com_pla')->_join('planificacion', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('plan', 'cur_com_pla_plb')->_join('plan', 'cur_com_pla', $render) . '
' . EntitySql::getInstanceRequire('calendario', 'cur_com_cal')->_join('calendario', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('asignatura', 'cur_asi')->_join('asignatura', 'cur', $render) . '
' . EntitySql::getInstanceRequire('dia', 'dia')->_join('dia', 'hora', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}hora_inicio": return $this->format->conditionTime($this->_mappingField($field), $value, $option);
    case "{$p}hora_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}hora_inicio"), $value, $option);

      case "{$p}hora_fin": return $this->format->conditionTime($this->_mappingField($field), $value, $option);
    case "{$p}hora_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}hora_fin"), $value, $option);

      case "{$p}curso": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}curso"), $value, $option);

      case "{$p}dia": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}dia"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_hora_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_hora_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_hora_inicio"), $value, $option);

      case "{$p}min_hora_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_hora_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_hora_inicio"), $value, $option);

      case "{$p}count_hora_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_hora_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_hora_inicio"), $value, $option);


      case "{$p}max_hora_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_hora_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_hora_fin"), $value, $option);

      case "{$p}min_hora_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_hora_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_hora_fin"), $value, $option);

      case "{$p}count_hora_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_hora_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_hora_fin"), $value, $option);


      case "{$p}max_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_curso"), $value, $option);

      case "{$p}min_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_curso"), $value, $option);

      case "{$p}count_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_curso"), $value, $option);


      case "{$p}max_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_dia"), $value, $option);

      case "{$p}min_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_dia"), $value, $option);

      case "{$p}count_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_dia"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('curso','cur')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','cur_com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','cur_com_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','cur_com_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','cur_com_sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','cur_com_moa')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','cur_com_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_com_pla_plb')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cur_com_cal')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','cur_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('dia','dia')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('curso','cur')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','cur_com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','cur_com_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','cur_com_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','cur_com_sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','cur_com_moa')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','cur_com_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_com_pla_plb')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cur_com_cal')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','cur_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('dia','dia')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('hora_inicio', $row)) $row_['hora_inicio'] = $this->format->time($row['hora_inicio']);
    if(array_key_exists('hora_fin', $row)) $row_['hora_fin'] = $this->format->time($row['hora_fin']);
    if(array_key_exists('curso', $row)) $row_['curso'] = $this->format->string($row['curso']);
    if(array_key_exists('dia', $row)) $row_['dia'] = $this->format->string($row['dia']);

    return $row_;
  }


}
