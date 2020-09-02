<?php
require_once("class/model/Sql.php");

class _PlanillaDocenteSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'insertado': return $t.".insertado";
      case $p.'insertado_date': return "CAST({$t}.insertado AS DATE)";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.numero)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'insertado') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}numero": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero"), $value, $option);

      case "{$p}insertado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}insertado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}insertado"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_numero"), $value, $option);

      case "{$p}min_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_numero"), $value, $option);

      case "{$p}count_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_numero"), $value, $option);


      case "{$p}avg_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_insertado"), $value, $option);

      case "{$p}max_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_insertado"), $value, $option);

      case "{$p}min_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_insertado"), $value, $option);

      case "{$p}count_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_insertado"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('numero', $row)) $row_['numero'] = $this->format->string($row['numero']);
    if(array_key_exists('insertado', $row)) $row_['insertado'] = $this->format->timestamp($row['insertado']);

    return $row_;
  }


}
