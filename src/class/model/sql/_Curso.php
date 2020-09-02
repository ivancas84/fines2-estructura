<?php
require_once("class/model/Sql.php");

class _CursoSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'comision': return $t.".comision";
      case $p.'asignatura': return $t.".asignatura";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case $p.'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case $p.'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case $p.'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case $p.'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_comision': return "MIN({$t}.comision)";
      case $p.'max_comision': return "MAX({$t}.comision)";
      case $p.'count_comision': return "COUNT({$t}.comision)";

      case $p.'min_asignatura': return "MIN({$t}.asignatura)";
      case $p.'max_asignatura': return "MAX({$t}.asignatura)";
      case $p.'count_asignatura': return "COUNT({$t}.asignatura)";

      case $p.'_label': return "CONCAT_WS(' ', {$p}com.division, {$p}com_sed.numero, {$p}com_sed.nombre, {$p}com_pla.anio, {$p}com_pla.semestre, {$p}com_pla_plb.orientacion, {$p}com_pla_plb.distribucion_horaria, {$p}com_cal.inicio, {$p}com_cal.fin, {$p}com_cal.anio, {$p}com_cal.semestre, {$p}asi.nombre)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('comision', 'com')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('sede', 'com_sed')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'com_sed_dom')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('tipo_sede', 'com_sed_ts')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('centro_educativo', 'com_sed_ce')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'com_sed_ce_dom')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('modalidad', 'com_moa')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('planificacion', 'com_pla')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('plan', 'com_pla_plb')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('calendario', 'com_cal')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('asignatura', 'asi')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'comision') . ' AS ' . $p.'comision, ' . $this->_mappingField($p.'asignatura') . ' AS ' . $p.'asignatura';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'horas_catedra') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'comision') . ', ' . $this->_mappingField($p.'asignatura') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('comision', 'com')->_fields() . ',
' . $this->container->getSql('sede', 'com_sed')->_fields() . ',
' . $this->container->getSql('domicilio', 'com_sed_dom')->_fields() . ',
' . $this->container->getSql('tipo_sede', 'com_sed_ts')->_fields() . ',
' . $this->container->getSql('centro_educativo', 'com_sed_ce')->_fields() . ',
' . $this->container->getSql('domicilio', 'com_sed_ce_dom')->_fields() . ',
' . $this->container->getSql('modalidad', 'com_moa')->_fields() . ',
' . $this->container->getSql('planificacion', 'com_pla')->_fields() . ',
' . $this->container->getSql('plan', 'com_pla_plb')->_fields() . ',
' . $this->container->getSql('calendario', 'com_cal')->_fields() . ',
' . $this->container->getSql('asignatura', 'asi')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('comision', 'com')->_join('comision', 'curs', $render) . '
' . $this->container->getSql('sede', 'com_sed')->_join('sede', 'com', $render) . '
' . $this->container->getSql('domicilio', 'com_sed_dom')->_join('domicilio', 'com_sed', $render) . '
' . $this->container->getSql('tipo_sede', 'com_sed_ts')->_join('tipo_sede', 'com_sed', $render) . '
' . $this->container->getSql('centro_educativo', 'com_sed_ce')->_join('centro_educativo', 'com_sed', $render) . '
' . $this->container->getSql('domicilio', 'com_sed_ce_dom')->_join('domicilio', 'com_sed_ce', $render) . '
' . $this->container->getSql('modalidad', 'com_moa')->_join('modalidad', 'com', $render) . '
' . $this->container->getSql('planificacion', 'com_pla')->_join('planificacion', 'com', $render) . '
' . $this->container->getSql('plan', 'com_pla_plb')->_join('plan', 'com_pla', $render) . '
' . $this->container->getSql('calendario', 'com_cal')->_join('calendario', 'com', $render) . '
' . $this->container->getSql('asignatura', 'asi')->_join('asignatura', 'curs', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}horas_catedra"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}comision": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}comision_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}comision"), $value, $option);

      case "{$p}asignatura": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}asignatura"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}sum_horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}sum_horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sum_horas_catedra"), $value, $option);

      case "{$p}avg_horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_horas_catedra"), $value, $option);

      case "{$p}max_horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_horas_catedra"), $value, $option);

      case "{$p}min_horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_horas_catedra"), $value, $option);

      case "{$p}count_horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_horas_catedra"), $value, $option);


      case "{$p}avg_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_alta"), $value, $option);

      case "{$p}max_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_alta"), $value, $option);

      case "{$p}min_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_alta"), $value, $option);

      case "{$p}count_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_alta"), $value, $option);


      case "{$p}max_comision": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_comision_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_comision"), $value, $option);

      case "{$p}min_comision": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_comision_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_comision"), $value, $option);

      case "{$p}count_comision": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_comision_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_comision"), $value, $option);


      case "{$p}max_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_asignatura"), $value, $option);

      case "{$p}min_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_asignatura"), $value, $option);

      case "{$p}count_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_asignatura"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('comision','com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('sede','com_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','com_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','com_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','com_sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','com_sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('modalidad','com_moa')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('planificacion','com_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('plan','com_pla_plb')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('calendario','com_cal')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('asignatura','asi')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('comision','com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('sede','com_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','com_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','com_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','com_sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','com_sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('modalidad','com_moa')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('planificacion','com_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('plan','com_pla_plb')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('calendario','com_cal')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('asignatura','asi')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('horas_catedra', $row)) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('comision', $row)) $row_['comision'] = $this->format->string($row['comision']);
    if(array_key_exists('asignatura', $row)) $row_['asignatura'] = $this->format->string($row['asignatura']);

    return $row_;
  }


}
