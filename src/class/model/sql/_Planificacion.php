<?php
require_once("class/model/Sql.php");

class _PlanificacionSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'anio': return $t.".anio";
      case $p.'semestre': return $t.".semestre";
      case $p.'plan': return $t.".plan";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_anio': return "MIN({$t}.anio)";
      case $p.'max_anio': return "MAX({$t}.anio)";
      case $p.'count_anio': return "COUNT({$t}.anio)";

      case $p.'min_semestre': return "MIN({$t}.semestre)";
      case $p.'max_semestre': return "MAX({$t}.semestre)";
      case $p.'count_semestre': return "COUNT({$t}.semestre)";

      case $p.'min_plan': return "MIN({$t}.plan)";
      case $p.'max_plan': return "MAX({$t}.plan)";
      case $p.'count_plan': return "COUNT({$t}.plan)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.anio, {$t}.semestre, {$p}plb.orientacion, {$p}plb.distribucion_horaria)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('plan', 'plb')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'anio') . ' AS ' . $p.'anio, ' . $this->_mappingField($p.'semestre') . ' AS ' . $p.'semestre, ' . $this->_mappingField($p.'plan') . ' AS ' . $p.'plan';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'anio') . ', ' . $this->_mappingField($p.'semestre') . ', ' . $this->_mappingField($p.'plan') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('plan', 'plb')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('plan', 'plb')->_join('plan', 'pla', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}anio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}anio"), $value, $option);

      case "{$p}semestre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}semestre"), $value, $option);

      case "{$p}plan": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}plan_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}plan"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_anio"), $value, $option);

      case "{$p}min_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_anio"), $value, $option);

      case "{$p}count_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_anio"), $value, $option);


      case "{$p}max_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_semestre"), $value, $option);

      case "{$p}min_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_semestre"), $value, $option);

      case "{$p}count_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_semestre"), $value, $option);


      case "{$p}max_plan": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_plan_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_plan"), $value, $option);

      case "{$p}min_plan": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_plan_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_plan"), $value, $option);

      case "{$p}count_plan": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_plan_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_plan"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('plan','plb')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('plan','plb')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('anio', $row)) $row_['anio'] = $this->format->string($row['anio']);
    if(array_key_exists('semestre', $row)) $row_['semestre'] = $this->format->string($row['semestre']);
    if(array_key_exists('plan', $row)) $row_['plan'] = $this->format->string($row['plan']);

    return $row_;
  }


}
