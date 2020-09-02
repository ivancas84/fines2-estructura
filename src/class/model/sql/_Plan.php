<?php
require_once("class/model/Sql.php");

class _PlanSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'orientacion': return $t.".orientacion";
      case $p.'resolucion': return $t.".resolucion";
      case $p.'distribucion_horaria': return $t.".distribucion_horaria";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_orientacion': return "MIN({$t}.orientacion)";
      case $p.'max_orientacion': return "MAX({$t}.orientacion)";
      case $p.'count_orientacion': return "COUNT({$t}.orientacion)";

      case $p.'min_resolucion': return "MIN({$t}.resolucion)";
      case $p.'max_resolucion': return "MAX({$t}.resolucion)";
      case $p.'count_resolucion': return "COUNT({$t}.resolucion)";

      case $p.'min_distribucion_horaria': return "MIN({$t}.distribucion_horaria)";
      case $p.'max_distribucion_horaria': return "MAX({$t}.distribucion_horaria)";
      case $p.'count_distribucion_horaria': return "COUNT({$t}.distribucion_horaria)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.orientacion, {$t}.distribucion_horaria)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'orientacion') . ' AS ' . $p.'orientacion, ' . $this->_mappingField($p.'resolucion') . ' AS ' . $p.'resolucion, ' . $this->_mappingField($p.'distribucion_horaria') . ' AS ' . $p.'distribucion_horaria';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'orientacion') . ', ' . $this->_mappingField($p.'resolucion') . ', ' . $this->_mappingField($p.'distribucion_horaria') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}orientacion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}orientacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}orientacion"), $value, $option);

      case "{$p}resolucion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}resolucion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}resolucion"), $value, $option);

      case "{$p}distribucion_horaria": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}distribucion_horaria_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}distribucion_horaria"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_orientacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_orientacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_orientacion"), $value, $option);

      case "{$p}min_orientacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_orientacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_orientacion"), $value, $option);

      case "{$p}count_orientacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_orientacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_orientacion"), $value, $option);


      case "{$p}max_resolucion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_resolucion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_resolucion"), $value, $option);

      case "{$p}min_resolucion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_resolucion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_resolucion"), $value, $option);

      case "{$p}count_resolucion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_resolucion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_resolucion"), $value, $option);


      case "{$p}max_distribucion_horaria": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_distribucion_horaria_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_distribucion_horaria"), $value, $option);

      case "{$p}min_distribucion_horaria": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_distribucion_horaria_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_distribucion_horaria"), $value, $option);

      case "{$p}count_distribucion_horaria": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_distribucion_horaria_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_distribucion_horaria"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('orientacion', $row)) $row_['orientacion'] = $this->format->string($row['orientacion']);
    if(array_key_exists('resolucion', $row)) $row_['resolucion'] = $this->format->string($row['resolucion']);
    if(array_key_exists('distribucion_horaria', $row)) $row_['distribucion_horaria'] = $this->format->string($row['distribucion_horaria']);

    return $row_;
  }


}
