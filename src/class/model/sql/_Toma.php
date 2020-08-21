<?php
require_once("class/model/Sql.php");

class _TomaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('toma');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_toma': return $t.".fecha_toma";
      case $p.'estado': return $t.".estado";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'comentario': return $t.".comentario";
      case $p.'tipo_movimiento': return $t.".tipo_movimiento";
      case $p.'estado_contralor': return $t.".estado_contralor";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'curso': return $t.".curso";
      case $p.'docente': return $t.".docente";
      case $p.'reemplazo': return $t.".reemplazo";
      case $p.'planilla_docente': return $t.".planilla_docente";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_fecha_toma': return "AVG({$t}.fecha_toma)";
      case $p.'min_fecha_toma': return "MIN({$t}.fecha_toma)";
      case $p.'max_fecha_toma': return "MAX({$t}.fecha_toma)";
      case $p.'count_fecha_toma': return "COUNT({$t}.fecha_toma)";

      case $p.'min_estado': return "MIN({$t}.estado)";
      case $p.'max_estado': return "MAX({$t}.estado)";
      case $p.'count_estado': return "COUNT({$t}.estado)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'min_comentario': return "MIN({$t}.comentario)";
      case $p.'max_comentario': return "MAX({$t}.comentario)";
      case $p.'count_comentario': return "COUNT({$t}.comentario)";

      case $p.'min_tipo_movimiento': return "MIN({$t}.tipo_movimiento)";
      case $p.'max_tipo_movimiento': return "MAX({$t}.tipo_movimiento)";
      case $p.'count_tipo_movimiento': return "COUNT({$t}.tipo_movimiento)";

      case $p.'min_estado_contralor': return "MIN({$t}.estado_contralor)";
      case $p.'max_estado_contralor': return "MAX({$t}.estado_contralor)";
      case $p.'count_estado_contralor': return "COUNT({$t}.estado_contralor)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_curso': return "MIN({$t}.curso)";
      case $p.'max_curso': return "MAX({$t}.curso)";
      case $p.'count_curso': return "COUNT({$t}.curso)";

      case $p.'min_docente': return "MIN({$t}.docente)";
      case $p.'max_docente': return "MAX({$t}.docente)";
      case $p.'count_docente': return "COUNT({$t}.docente)";

      case $p.'min_reemplazo': return "MIN({$t}.reemplazo)";
      case $p.'max_reemplazo': return "MAX({$t}.reemplazo)";
      case $p.'count_reemplazo': return "COUNT({$t}.reemplazo)";

      case $p.'min_planilla_docente': return "MIN({$t}.planilla_docente)";
      case $p.'max_planilla_docente': return "MAX({$t}.planilla_docente)";
      case $p.'count_planilla_docente': return "COUNT({$t}.planilla_docente)";

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
    if($f = EntitySql::getInstanceRequire('persona', 'doc')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'doc_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'ree')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'ree_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planilla_docente', 'pd')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'fecha_toma') . ' AS ' . $p.'fecha_toma, ' . $this->_mappingField($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'comentario') . ' AS ' . $p.'comentario, ' . $this->_mappingField($p.'tipo_movimiento') . ' AS ' . $p.'tipo_movimiento, ' . $this->_mappingField($p.'estado_contralor') . ' AS ' . $p.'estado_contralor, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'curso') . ' AS ' . $p.'curso, ' . $this->_mappingField($p.'docente') . ' AS ' . $p.'docente, ' . $this->_mappingField($p.'reemplazo') . ' AS ' . $p.'reemplazo, ' . $this->_mappingField($p.'planilla_docente') . ' AS ' . $p.'planilla_docente';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'fecha_toma') . ', ' . $this->_mappingField($p.'estado') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'comentario') . ', ' . $this->_mappingField($p.'tipo_movimiento') . ', ' . $this->_mappingField($p.'estado_contralor') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'curso') . ', ' . $this->_mappingField($p.'docente') . ', ' . $this->_mappingField($p.'reemplazo') . ', ' . $this->_mappingField($p.'planilla_docente') . '';
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
' . EntitySql::getInstanceRequire('persona', 'doc')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'doc_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'ree')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'ree_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('planilla_docente', 'pd')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('curso', 'cur')->_join('curso', 'toma', $render) . '
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
' . EntitySql::getInstanceRequire('persona', 'doc')->_join('docente', 'toma', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'doc_dom')->_join('domicilio', 'doc', $render) . '
' . EntitySql::getInstanceRequire('persona', 'ree')->_join('reemplazo', 'toma', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'ree_dom')->_join('domicilio', 'ree', $render) . '
' . EntitySql::getInstanceRequire('planilla_docente', 'pd')->_join('planilla_docente', 'toma', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}fecha_toma": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}fecha_toma_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fecha_toma"), $value, $option);

      case "{$p}estado": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}estado"), $value, $option);

      case "{$p}observaciones": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}observaciones"), $value, $option);

      case "{$p}comentario": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}comentario"), $value, $option);

      case "{$p}tipo_movimiento": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}tipo_movimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}tipo_movimiento"), $value, $option);

      case "{$p}estado_contralor": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}estado_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}estado_contralor"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}curso": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}curso"), $value, $option);

      case "{$p}docente": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}docente"), $value, $option);

      case "{$p}reemplazo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}reemplazo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}reemplazo"), $value, $option);

      case "{$p}planilla_docente": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}planilla_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}planilla_docente"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}avg_fecha_toma": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fecha_toma_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fecha_toma"), $value, $option);

      case "{$p}max_fecha_toma": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fecha_toma_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fecha_toma"), $value, $option);

      case "{$p}min_fecha_toma": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fecha_toma_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fecha_toma"), $value, $option);

      case "{$p}count_fecha_toma": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fecha_toma_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fecha_toma"), $value, $option);


      case "{$p}max_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_estado"), $value, $option);

      case "{$p}min_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_estado"), $value, $option);

      case "{$p}count_estado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_estado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_estado"), $value, $option);


      case "{$p}max_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_observaciones"), $value, $option);

      case "{$p}min_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_observaciones"), $value, $option);

      case "{$p}count_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_observaciones"), $value, $option);


      case "{$p}max_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_comentario"), $value, $option);

      case "{$p}min_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_comentario"), $value, $option);

      case "{$p}count_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_comentario"), $value, $option);


      case "{$p}max_tipo_movimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_tipo_movimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_tipo_movimiento"), $value, $option);

      case "{$p}min_tipo_movimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_tipo_movimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_tipo_movimiento"), $value, $option);

      case "{$p}count_tipo_movimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_tipo_movimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_tipo_movimiento"), $value, $option);


      case "{$p}max_estado_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_estado_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_estado_contralor"), $value, $option);

      case "{$p}min_estado_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_estado_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_estado_contralor"), $value, $option);

      case "{$p}count_estado_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_estado_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_estado_contralor"), $value, $option);


      case "{$p}avg_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_alta"), $value, $option);

      case "{$p}max_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_alta"), $value, $option);

      case "{$p}min_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_alta"), $value, $option);

      case "{$p}count_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_alta"), $value, $option);


      case "{$p}max_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_curso"), $value, $option);

      case "{$p}min_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_curso"), $value, $option);

      case "{$p}count_curso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_curso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_curso"), $value, $option);


      case "{$p}max_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_docente"), $value, $option);

      case "{$p}min_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_docente"), $value, $option);

      case "{$p}count_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_docente"), $value, $option);


      case "{$p}max_reemplazo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_reemplazo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_reemplazo"), $value, $option);

      case "{$p}min_reemplazo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_reemplazo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_reemplazo"), $value, $option);

      case "{$p}count_reemplazo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_reemplazo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_reemplazo"), $value, $option);


      case "{$p}max_planilla_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_planilla_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_planilla_docente"), $value, $option);

      case "{$p}min_planilla_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_planilla_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_planilla_docente"), $value, $option);

      case "{$p}count_planilla_docente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_planilla_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_planilla_docente"), $value, $option);


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
    if($c = EntitySql::getInstanceRequire('persona','doc')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','doc_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','ree')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','ree_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planilla_docente','pd')->_conditionFieldStruct($field, $option, $value)) return $c;
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
    if($c = EntitySql::getInstanceRequire('persona','doc')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','doc_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','ree')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','ree_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planilla_docente','pd')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('fecha_toma', $row)) $row_['fecha_toma'] = $this->format->date($row['fecha_toma']);
    if(array_key_exists('estado', $row)) $row_['estado'] = $this->format->string($row['estado']);
    if(array_key_exists('observaciones', $row)) $row_['observaciones'] = $this->format->string($row['observaciones']);
    if(array_key_exists('comentario', $row)) $row_['comentario'] = $this->format->string($row['comentario']);
    if(array_key_exists('tipo_movimiento', $row)) $row_['tipo_movimiento'] = $this->format->string($row['tipo_movimiento']);
    if(array_key_exists('estado_contralor', $row)) $row_['estado_contralor'] = $this->format->string($row['estado_contralor']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('curso', $row)) $row_['curso'] = $this->format->string($row['curso']);
    if(array_key_exists('docente', $row)) $row_['docente'] = $this->format->string($row['docente']);
    if(array_key_exists('reemplazo', $row)) $row_['reemplazo'] = $this->format->string($row['reemplazo']);
    if(array_key_exists('planilla_docente', $row)) $row_['planilla_docente'] = $this->format->string($row['planilla_docente']);

    return $row_;
  }


}
