<?php
require_once("class/model/Sql.php");

class _DiaSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'dia': return $t.".dia";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_numero': return "SUM({$t}.numero)";
      case $p.'avg_numero': return "AVG({$t}.numero)";
      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'min_dia': return "MIN({$t}.dia)";
      case $p.'max_dia': return "MAX({$t}.dia)";
      case $p.'count_dia': return "COUNT({$t}.dia)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.dia)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'dia') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero"), $value, $option);

      case "{$p}dia": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}dia"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}sum_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}sum_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sum_numero"), $value, $option);

      case "{$p}avg_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_numero"), $value, $option);

      case "{$p}max_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_numero"), $value, $option);

      case "{$p}min_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_numero"), $value, $option);

      case "{$p}count_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_numero"), $value, $option);


      case "{$p}max_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_dia"), $value, $option);

      case "{$p}min_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_dia"), $value, $option);

      case "{$p}count_dia": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_dia_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_dia"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('numero', $row)) $row_['numero'] = $this->format->numeric($row['numero']);
    if(array_key_exists('dia', $row)) $row_['dia'] = $this->format->string($row['dia']);

    return $row_;
  }


}
