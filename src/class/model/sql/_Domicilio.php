<?php
require_once("class/model/Sql.php");

class _DomicilioSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'calle': return $t.".calle";
      case $p.'entre': return $t.".entre";
      case $p.'numero': return $t.".numero";
      case $p.'piso': return $t.".piso";
      case $p.'departamento': return $t.".departamento";
      case $p.'barrio': return $t.".barrio";
      case $p.'localidad': return $t.".localidad";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_calle': return "MIN({$t}.calle)";
      case $p.'max_calle': return "MAX({$t}.calle)";
      case $p.'count_calle': return "COUNT({$t}.calle)";

      case $p.'min_entre': return "MIN({$t}.entre)";
      case $p.'max_entre': return "MAX({$t}.entre)";
      case $p.'count_entre': return "COUNT({$t}.entre)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'min_piso': return "MIN({$t}.piso)";
      case $p.'max_piso': return "MAX({$t}.piso)";
      case $p.'count_piso': return "COUNT({$t}.piso)";

      case $p.'min_departamento': return "MIN({$t}.departamento)";
      case $p.'max_departamento': return "MAX({$t}.departamento)";
      case $p.'count_departamento': return "COUNT({$t}.departamento)";

      case $p.'min_barrio': return "MIN({$t}.barrio)";
      case $p.'max_barrio': return "MAX({$t}.barrio)";
      case $p.'count_barrio': return "COUNT({$t}.barrio)";

      case $p.'min_localidad': return "MIN({$t}.localidad)";
      case $p.'max_localidad': return "MAX({$t}.localidad)";
      case $p.'count_localidad': return "COUNT({$t}.localidad)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.calle, {$t}.numero, {$t}.barrio)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'calle') . ' AS ' . $p.'calle, ' . $this->_mappingField($p.'entre') . ' AS ' . $p.'entre, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'piso') . ' AS ' . $p.'piso, ' . $this->_mappingField($p.'departamento') . ' AS ' . $p.'departamento, ' . $this->_mappingField($p.'barrio') . ' AS ' . $p.'barrio, ' . $this->_mappingField($p.'localidad') . ' AS ' . $p.'localidad';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'calle') . ', ' . $this->_mappingField($p.'entre') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'piso') . ', ' . $this->_mappingField($p.'departamento') . ', ' . $this->_mappingField($p.'barrio') . ', ' . $this->_mappingField($p.'localidad') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}calle": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}calle_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}calle"), $value, $option);

      case "{$p}entre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}entre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}entre"), $value, $option);

      case "{$p}numero": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero"), $value, $option);

      case "{$p}piso": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}piso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}piso"), $value, $option);

      case "{$p}departamento": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}departamento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}departamento"), $value, $option);

      case "{$p}barrio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}barrio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}barrio"), $value, $option);

      case "{$p}localidad": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}localidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}localidad"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_calle": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_calle_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_calle"), $value, $option);

      case "{$p}min_calle": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_calle_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_calle"), $value, $option);

      case "{$p}count_calle": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_calle_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_calle"), $value, $option);


      case "{$p}max_entre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_entre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_entre"), $value, $option);

      case "{$p}min_entre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_entre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_entre"), $value, $option);

      case "{$p}count_entre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_entre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_entre"), $value, $option);


      case "{$p}max_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_numero"), $value, $option);

      case "{$p}min_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_numero"), $value, $option);

      case "{$p}count_numero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_numero"), $value, $option);


      case "{$p}max_piso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_piso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_piso"), $value, $option);

      case "{$p}min_piso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_piso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_piso"), $value, $option);

      case "{$p}count_piso": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_piso_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_piso"), $value, $option);


      case "{$p}max_departamento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_departamento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_departamento"), $value, $option);

      case "{$p}min_departamento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_departamento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_departamento"), $value, $option);

      case "{$p}count_departamento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_departamento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_departamento"), $value, $option);


      case "{$p}max_barrio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_barrio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_barrio"), $value, $option);

      case "{$p}min_barrio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_barrio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_barrio"), $value, $option);

      case "{$p}count_barrio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_barrio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_barrio"), $value, $option);


      case "{$p}max_localidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_localidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_localidad"), $value, $option);

      case "{$p}min_localidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_localidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_localidad"), $value, $option);

      case "{$p}count_localidad": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_localidad_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_localidad"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('calle', $row)) $row_['calle'] = $this->format->string($row['calle']);
    if(array_key_exists('entre', $row)) $row_['entre'] = $this->format->string($row['entre']);
    if(array_key_exists('numero', $row)) $row_['numero'] = $this->format->string($row['numero']);
    if(array_key_exists('piso', $row)) $row_['piso'] = $this->format->string($row['piso']);
    if(array_key_exists('departamento', $row)) $row_['departamento'] = $this->format->string($row['departamento']);
    if(array_key_exists('barrio', $row)) $row_['barrio'] = $this->format->string($row['barrio']);
    if(array_key_exists('localidad', $row)) $row_['localidad'] = $this->format->string($row['localidad']);

    return $row_;
  }


}
