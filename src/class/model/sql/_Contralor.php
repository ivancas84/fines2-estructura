<?php
require_once("class/model/Sql.php");

class _ContralorSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_contralor': return $t.".fecha_contralor";
      case $p.'fecha_consejo': return $t.".fecha_consejo";
      case $p.'insertado': return $t.".insertado";
      case $p.'insertado_date': return "CAST({$t}.insertado AS DATE)";
      case $p.'planilla_docente': return $t.".planilla_docente";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_fecha_contralor': return "AVG({$t}.fecha_contralor)";
      case $p.'min_fecha_contralor': return "MIN({$t}.fecha_contralor)";
      case $p.'max_fecha_contralor': return "MAX({$t}.fecha_contralor)";
      case $p.'count_fecha_contralor': return "COUNT({$t}.fecha_contralor)";

      case $p.'avg_fecha_consejo': return "AVG({$t}.fecha_consejo)";
      case $p.'min_fecha_consejo': return "MIN({$t}.fecha_consejo)";
      case $p.'max_fecha_consejo': return "MAX({$t}.fecha_consejo)";
      case $p.'count_fecha_consejo': return "COUNT({$t}.fecha_consejo)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'min_planilla_docente': return "MIN({$t}.planilla_docente)";
      case $p.'max_planilla_docente': return "MAX({$t}.planilla_docente)";
      case $p.'count_planilla_docente': return "COUNT({$t}.planilla_docente)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('planilla_docente', 'pd')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'fecha_contralor') . ' AS ' . $p.'fecha_contralor, ' . $this->_mappingField($p.'fecha_consejo') . ' AS ' . $p.'fecha_consejo, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado, ' . $this->_mappingField($p.'planilla_docente') . ' AS ' . $p.'planilla_docente';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'fecha_contralor') . ', ' . $this->_mappingField($p.'fecha_consejo') . ', ' . $this->_mappingField($p.'insertado') . ', ' . $this->_mappingField($p.'planilla_docente') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('planilla_docente', 'pd')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('planilla_docente', 'pd')->_join('planilla_docente', 'cont', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}fecha_contralor": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}fecha_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fecha_contralor"), $value, $option);

      case "{$p}fecha_consejo": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}fecha_consejo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fecha_consejo"), $value, $option);

      case "{$p}insertado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}insertado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}insertado"), $value, $option);

      case "{$p}planilla_docente": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}planilla_docente_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}planilla_docente"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}avg_fecha_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fecha_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fecha_contralor"), $value, $option);

      case "{$p}max_fecha_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fecha_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fecha_contralor"), $value, $option);

      case "{$p}min_fecha_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fecha_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fecha_contralor"), $value, $option);

      case "{$p}count_fecha_contralor": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fecha_contralor_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fecha_contralor"), $value, $option);


      case "{$p}avg_fecha_consejo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fecha_consejo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fecha_consejo"), $value, $option);

      case "{$p}max_fecha_consejo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fecha_consejo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fecha_consejo"), $value, $option);

      case "{$p}min_fecha_consejo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fecha_consejo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fecha_consejo"), $value, $option);

      case "{$p}count_fecha_consejo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fecha_consejo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fecha_consejo"), $value, $option);


      case "{$p}avg_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_insertado"), $value, $option);

      case "{$p}max_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_insertado"), $value, $option);

      case "{$p}min_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_insertado"), $value, $option);

      case "{$p}count_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_insertado"), $value, $option);


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
    if($c = $this->container->getSql('planilla_docente','pd')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('planilla_docente','pd')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('fecha_contralor', $row)) $row_['fecha_contralor'] = $this->format->date($row['fecha_contralor']);
    if(array_key_exists('fecha_consejo', $row)) $row_['fecha_consejo'] = $this->format->date($row['fecha_consejo']);
    if(array_key_exists('insertado', $row)) $row_['insertado'] = $this->format->timestamp($row['insertado']);
    if(array_key_exists('planilla_docente', $row)) $row_['planilla_docente'] = $this->format->string($row['planilla_docente']);

    return $row_;
  }


}
