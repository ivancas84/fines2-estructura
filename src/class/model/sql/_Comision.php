<?php
require_once("class/model/Sql.php");

class _ComisionSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('comision');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'turno': return $t.".turno";
      case $p.'division': return $t.".division";
      case $p.'comentario': return $t.".comentario";
      case $p.'autorizada': return $t.".autorizada";
      case $p.'apertura': return $t.".apertura";
      case $p.'publicada': return $t.".publicada";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'sede': return $t.".sede";
      case $p.'modalidad': return $t.".modalidad";
      case $p.'planificacion': return $t.".planificacion";
      case $p.'comision_siguiente': return $t.".comision_siguiente";
      case $p.'calendario': return $t.".calendario";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_turno': return "MIN({$t}.turno)";
      case $p.'max_turno': return "MAX({$t}.turno)";
      case $p.'count_turno': return "COUNT({$t}.turno)";

      case $p.'min_division': return "MIN({$t}.division)";
      case $p.'max_division': return "MAX({$t}.division)";
      case $p.'count_division': return "COUNT({$t}.division)";

      case $p.'min_comentario': return "MIN({$t}.comentario)";
      case $p.'max_comentario': return "MAX({$t}.comentario)";
      case $p.'count_comentario': return "COUNT({$t}.comentario)";

      case $p.'min_autorizada': return "MIN({$t}.autorizada)";
      case $p.'max_autorizada': return "MAX({$t}.autorizada)";
      case $p.'count_autorizada': return "COUNT({$t}.autorizada)";

      case $p.'min_apertura': return "MIN({$t}.apertura)";
      case $p.'max_apertura': return "MAX({$t}.apertura)";
      case $p.'count_apertura': return "COUNT({$t}.apertura)";

      case $p.'min_publicada': return "MIN({$t}.publicada)";
      case $p.'max_publicada': return "MAX({$t}.publicada)";
      case $p.'count_publicada': return "COUNT({$t}.publicada)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_sede': return "MIN({$t}.sede)";
      case $p.'max_sede': return "MAX({$t}.sede)";
      case $p.'count_sede': return "COUNT({$t}.sede)";

      case $p.'min_modalidad': return "MIN({$t}.modalidad)";
      case $p.'max_modalidad': return "MAX({$t}.modalidad)";
      case $p.'count_modalidad': return "COUNT({$t}.modalidad)";

      case $p.'min_planificacion': return "MIN({$t}.planificacion)";
      case $p.'max_planificacion': return "MAX({$t}.planificacion)";
      case $p.'count_planificacion': return "COUNT({$t}.planificacion)";

      case $p.'min_comision_siguiente': return "MIN({$t}.comision_siguiente)";
      case $p.'max_comision_siguiente': return "MAX({$t}.comision_siguiente)";
      case $p.'count_comision_siguiente': return "COUNT({$t}.comision_siguiente)";

      case $p.'min_calendario': return "MIN({$t}.calendario)";
      case $p.'max_calendario': return "MAX({$t}.calendario)";
      case $p.'count_calendario': return "COUNT({$t}.calendario)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.division, {$p}sed.numero, {$p}sed.nombre, {$p}pla.anio, {$p}pla.semestre, {$p}pla_plb.orientacion, {$p}pla_plb.distribucion_horaria, {$p}cal.inicio, {$p}cal.fin, {$p}cal.anio, {$p}cal.semestre)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('modalidad', 'moa')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planificacion', 'pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'pla_plb')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('calendario', 'cal')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'turno') . ' AS ' . $p.'turno, ' . $this->_mappingField($p.'division') . ' AS ' . $p.'division, ' . $this->_mappingField($p.'comentario') . ' AS ' . $p.'comentario, ' . $this->_mappingField($p.'autorizada') . ' AS ' . $p.'autorizada, ' . $this->_mappingField($p.'apertura') . ' AS ' . $p.'apertura, ' . $this->_mappingField($p.'publicada') . ' AS ' . $p.'publicada, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'sede') . ' AS ' . $p.'sede, ' . $this->_mappingField($p.'modalidad') . ' AS ' . $p.'modalidad, ' . $this->_mappingField($p.'planificacion') . ' AS ' . $p.'planificacion, ' . $this->_mappingField($p.'comision_siguiente') . ' AS ' . $p.'comision_siguiente, ' . $this->_mappingField($p.'calendario') . ' AS ' . $p.'calendario';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'turno') . ', ' . $this->_mappingField($p.'division') . ', ' . $this->_mappingField($p.'comentario') . ', ' . $this->_mappingField($p.'autorizada') . ', ' . $this->_mappingField($p.'apertura') . ', ' . $this->_mappingField($p.'publicada') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'sede') . ', ' . $this->_mappingField($p.'modalidad') . ', ' . $this->_mappingField($p.'planificacion') . ', ' . $this->_mappingField($p.'comision_siguiente') . ', ' . $this->_mappingField($p.'calendario') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'sed')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('modalidad', 'moa')->_fields() . ',
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_fields() . ',
' . EntitySql::getInstanceRequire('calendario', 'cal')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('sede', 'sed')->_join('sede', 'comi', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . EntitySql::getInstanceRequire('modalidad', 'moa')->_join('modalidad', 'comi', $render) . '
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_join('planificacion', 'comi', $render) . '
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' . EntitySql::getInstanceRequire('calendario', 'cal')->_join('calendario', 'comi', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}turno": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}turno_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}turno"), $value, $option);

      case "{$p}division": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}division_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}division"), $value, $option);

      case "{$p}comentario": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}comentario"), $value, $option);

      case "{$p}autorizada": return $this->format->conditionBoolean($this->_mappingField($field), $value);
    case "{$p}autorizada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}autorizada"), $value, $option);

      case "{$p}apertura": return $this->format->conditionBoolean($this->_mappingField($field), $value);
    case "{$p}apertura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}apertura"), $value, $option);

      case "{$p}publicada": return $this->format->conditionBoolean($this->_mappingField($field), $value);
    case "{$p}publicada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}publicada"), $value, $option);

      case "{$p}observaciones": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}observaciones"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}sede": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sede"), $value, $option);

      case "{$p}modalidad": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}modalidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}modalidad"), $value, $option);

      case "{$p}planificacion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}planificacion"), $value, $option);

      case "{$p}comision_siguiente": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}comision_siguiente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}comision_siguiente"), $value, $option);

      case "{$p}calendario": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}calendario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}calendario"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_turno": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_turno_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_turno"), $value, $option);

      case "{$p}min_turno": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_turno_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_turno"), $value, $option);

      case "{$p}count_turno": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_turno_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_turno"), $value, $option);


      case "{$p}max_division": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_division_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_division"), $value, $option);

      case "{$p}min_division": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_division_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_division"), $value, $option);

      case "{$p}count_division": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_division_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_division"), $value, $option);


      case "{$p}max_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_comentario"), $value, $option);

      case "{$p}min_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_comentario"), $value, $option);

      case "{$p}count_comentario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_comentario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_comentario"), $value, $option);


      case "{$p}max_autorizada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_autorizada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_autorizada"), $value, $option);

      case "{$p}min_autorizada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_autorizada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_autorizada"), $value, $option);

      case "{$p}count_autorizada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_autorizada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_autorizada"), $value, $option);


      case "{$p}max_apertura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_apertura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_apertura"), $value, $option);

      case "{$p}min_apertura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_apertura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_apertura"), $value, $option);

      case "{$p}count_apertura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_apertura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_apertura"), $value, $option);


      case "{$p}max_publicada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_publicada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_publicada"), $value, $option);

      case "{$p}min_publicada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_publicada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_publicada"), $value, $option);

      case "{$p}count_publicada": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_publicada_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_publicada"), $value, $option);


      case "{$p}max_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_observaciones"), $value, $option);

      case "{$p}min_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_observaciones"), $value, $option);

      case "{$p}count_observaciones": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_observaciones"), $value, $option);


      case "{$p}avg_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_alta"), $value, $option);

      case "{$p}max_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_alta"), $value, $option);

      case "{$p}min_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_alta"), $value, $option);

      case "{$p}count_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_alta"), $value, $option);


      case "{$p}max_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_sede"), $value, $option);

      case "{$p}min_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_sede"), $value, $option);

      case "{$p}count_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_sede"), $value, $option);


      case "{$p}max_modalidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_modalidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_modalidad"), $value, $option);

      case "{$p}min_modalidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_modalidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_modalidad"), $value, $option);

      case "{$p}count_modalidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_modalidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_modalidad"), $value, $option);


      case "{$p}max_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_planificacion"), $value, $option);

      case "{$p}min_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_planificacion"), $value, $option);

      case "{$p}count_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_planificacion"), $value, $option);


      case "{$p}max_comision_siguiente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_comision_siguiente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_comision_siguiente"), $value, $option);

      case "{$p}min_comision_siguiente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_comision_siguiente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_comision_siguiente"), $value, $option);

      case "{$p}count_comision_siguiente": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_comision_siguiente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_comision_siguiente"), $value, $option);


      case "{$p}max_calendario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_calendario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_calendario"), $value, $option);

      case "{$p}min_calendario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_calendario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_calendario"), $value, $option);

      case "{$p}count_calendario": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_calendario_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_calendario"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','moa')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cal')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','moa')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cal')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('turno', $row)) $row_['turno'] = $this->format->string($row['turno']);
    if(array_key_exists('division', $row)) $row_['division'] = $this->format->string($row['division']);
    if(array_key_exists('comentario', $row)) $row_['comentario'] = $this->format->string($row['comentario']);
    if(array_key_exists('autorizada', $row)) $row_['autorizada'] = $this->format->boolean($row['autorizada']);
    if(array_key_exists('apertura', $row)) $row_['apertura'] = $this->format->boolean($row['apertura']);
    if(array_key_exists('publicada', $row)) $row_['publicada'] = $this->format->boolean($row['publicada']);
    if(array_key_exists('observaciones', $row)) $row_['observaciones'] = $this->format->string($row['observaciones']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('sede', $row)) $row_['sede'] = $this->format->string($row['sede']);
    if(array_key_exists('modalidad', $row)) $row_['modalidad'] = $this->format->string($row['modalidad']);
    if(array_key_exists('planificacion', $row)) $row_['planificacion'] = $this->format->string($row['planificacion']);
    if(array_key_exists('comision_siguiente', $row)) $row_['comision_siguiente'] = $this->format->string($row['comision_siguiente']);
    if(array_key_exists('calendario', $row)) $row_['calendario'] = $this->format->string($row['calendario']);

    return $row_;
  }


}
