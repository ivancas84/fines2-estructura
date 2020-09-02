<?php
require_once("class/model/Sql.php");

class _DesignacionSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'desde': return $t.".desde";
      case $p.'hasta': return $t.".hasta";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'cargo': return $t.".cargo";
      case $p.'sede': return $t.".sede";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_desde': return "AVG({$t}.desde)";
      case $p.'min_desde': return "MIN({$t}.desde)";
      case $p.'max_desde': return "MAX({$t}.desde)";
      case $p.'count_desde': return "COUNT({$t}.desde)";

      case $p.'avg_hasta': return "AVG({$t}.hasta)";
      case $p.'min_hasta': return "MIN({$t}.hasta)";
      case $p.'max_hasta': return "MAX({$t}.hasta)";
      case $p.'count_hasta': return "COUNT({$t}.hasta)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_cargo': return "MIN({$t}.cargo)";
      case $p.'max_cargo': return "MAX({$t}.cargo)";
      case $p.'count_cargo': return "COUNT({$t}.cargo)";

      case $p.'min_sede': return "MIN({$t}.sede)";
      case $p.'max_sede': return "MAX({$t}.sede)";
      case $p.'count_sede': return "COUNT({$t}.sede)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('cargo', 'car')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('sede', 'sed')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'sed_dom')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('tipo_sede', 'sed_ts')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('centro_educativo', 'sed_ce')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'sed_ce_dom')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('persona', 'per')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'per_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'desde') . ' AS ' . $p.'desde, ' . $this->_mappingField($p.'hasta') . ' AS ' . $p.'hasta, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'cargo') . ' AS ' . $p.'cargo, ' . $this->_mappingField($p.'sede') . ' AS ' . $p.'sede, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'desde') . ', ' . $this->_mappingField($p.'hasta') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'cargo') . ', ' . $this->_mappingField($p.'sede') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('cargo', 'car')->_fields() . ',
' . $this->container->getSql('sede', 'sed')->_fields() . ',
' . $this->container->getSql('domicilio', 'sed_dom')->_fields() . ',
' . $this->container->getSql('tipo_sede', 'sed_ts')->_fields() . ',
' . $this->container->getSql('centro_educativo', 'sed_ce')->_fields() . ',
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_fields() . ',
' . $this->container->getSql('persona', 'per')->_fields() . ',
' . $this->container->getSql('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('cargo', 'car')->_join('cargo', 'desi', $render) . '
' . $this->container->getSql('sede', 'sed')->_join('sede', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . $this->container->getSql('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . $this->container->getSql('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . $this->container->getSql('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . $this->container->getSql('persona', 'per')->_join('persona', 'desi', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}desde": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}desde_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}desde"), $value, $option);

      case "{$p}hasta": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}hasta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}hasta"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}cargo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}cargo"), $value, $option);

      case "{$p}sede": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sede"), $value, $option);

      case "{$p}persona": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}persona"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}avg_desde": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_desde_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_desde"), $value, $option);

      case "{$p}max_desde": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_desde_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_desde"), $value, $option);

      case "{$p}min_desde": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_desde_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_desde"), $value, $option);

      case "{$p}count_desde": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_desde_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_desde"), $value, $option);


      case "{$p}avg_hasta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_hasta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_hasta"), $value, $option);

      case "{$p}max_hasta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_hasta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_hasta"), $value, $option);

      case "{$p}min_hasta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_hasta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_hasta"), $value, $option);

      case "{$p}count_hasta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_hasta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_hasta"), $value, $option);


      case "{$p}avg_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_alta"), $value, $option);

      case "{$p}max_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_alta"), $value, $option);

      case "{$p}min_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_alta"), $value, $option);

      case "{$p}count_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_alta"), $value, $option);


      case "{$p}max_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_cargo"), $value, $option);

      case "{$p}min_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_cargo"), $value, $option);

      case "{$p}count_cargo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_cargo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_cargo"), $value, $option);


      case "{$p}max_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_sede"), $value, $option);

      case "{$p}min_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_sede"), $value, $option);

      case "{$p}count_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_sede"), $value, $option);


      case "{$p}max_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_persona"), $value, $option);

      case "{$p}min_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_persona"), $value, $option);

      case "{$p}count_persona": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_persona"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','per_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('cargo','car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','per_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('desde', $row)) $row_['desde'] = $this->format->date($row['desde']);
    if(array_key_exists('hasta', $row)) $row_['hasta'] = $this->format->date($row['hasta']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('cargo', $row)) $row_['cargo'] = $this->format->string($row['cargo']);
    if(array_key_exists('sede', $row)) $row_['sede'] = $this->format->string($row['sede']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }


}
