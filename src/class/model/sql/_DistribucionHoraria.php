<?php
require_once("class/model/Sql.php");

class _DistribucionHorariaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('distribucion_horaria');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'dia': return $t.".dia";
      case $p.'asignatura': return $t.".asignatura";
      case $p.'planificacion': return $t.".planificacion";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case $p.'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case $p.'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case $p.'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case $p.'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case $p.'sum_dia': return "SUM({$t}.dia)";
      case $p.'avg_dia': return "AVG({$t}.dia)";
      case $p.'min_dia': return "MIN({$t}.dia)";
      case $p.'max_dia': return "MAX({$t}.dia)";
      case $p.'count_dia': return "COUNT({$t}.dia)";

      case $p.'min_asignatura': return "MIN({$t}.asignatura)";
      case $p.'max_asignatura': return "MAX({$t}.asignatura)";
      case $p.'count_asignatura': return "COUNT({$t}.asignatura)";

      case $p.'min_planificacion': return "MIN({$t}.planificacion)";
      case $p.'max_planificacion': return "MAX({$t}.planificacion)";
      case $p.'count_planificacion': return "COUNT({$t}.planificacion)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('asignatura', 'asi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planificacion', 'pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'pla_plb')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia, ' . $this->_mappingField($p.'asignatura') . ' AS ' . $p.'asignatura, ' . $this->_mappingField($p.'planificacion') . ' AS ' . $p.'planificacion';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'horas_catedra') . ', ' . $this->_mappingField($p.'dia') . ', ' . $this->_mappingField($p.'asignatura') . ', ' . $this->_mappingField($p.'planificacion') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('asignatura', 'asi')->_fields() . ',
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('asignatura', 'asi')->_join('asignatura', 'dh', $render) . '
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_join('planificacion', 'dh', $render) . '
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}horas_catedra": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}horas_catedra_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}horas_catedra"), $value, $option);

      case "{$p}dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}dia"), $value, $option);

      case "{$p}asignatura": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}asignatura"), $value, $option);

      case "{$p}planificacion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}planificacion"), $value, $option);


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


      case "{$p}sum_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}sum_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sum_dia"), $value, $option);

      case "{$p}avg_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_dia"), $value, $option);

      case "{$p}max_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_dia"), $value, $option);

      case "{$p}min_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_dia"), $value, $option);

      case "{$p}count_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_dia"), $value, $option);


      case "{$p}max_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_asignatura"), $value, $option);

      case "{$p}min_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_asignatura"), $value, $option);

      case "{$p}count_asignatura": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_asignatura_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_asignatura"), $value, $option);


      case "{$p}max_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_planificacion"), $value, $option);

      case "{$p}min_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_planificacion"), $value, $option);

      case "{$p}count_planificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_planificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_planificacion"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('horas_catedra', $row)) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(array_key_exists('dia', $row)) $row_['dia'] = $this->format->numeric($row['dia']);
    if(array_key_exists('asignatura', $row)) $row_['asignatura'] = $this->format->string($row['asignatura']);
    if(array_key_exists('planificacion', $row)) $row_['planificacion'] = $this->format->string($row['planificacion']);

    return $row_;
  }


}
