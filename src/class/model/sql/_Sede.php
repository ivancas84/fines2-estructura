<?php
require_once("class/model/Sql.php");

class _SedeSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'nombre': return $t.".nombre";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'baja': return $t.".baja";
      case $p.'baja_date': return "CAST({$t}.baja AS DATE)";
      case $p.'domicilio': return $t.".domicilio";
      case $p.'tipo_sede': return $t.".tipo_sede";
      case $p.'centro_educativo': return $t.".centro_educativo";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'min_nombre': return "MIN({$t}.nombre)";
      case $p.'max_nombre': return "MAX({$t}.nombre)";
      case $p.'count_nombre': return "COUNT({$t}.nombre)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      case $p.'min_tipo_sede': return "MIN({$t}.tipo_sede)";
      case $p.'max_tipo_sede': return "MAX({$t}.tipo_sede)";
      case $p.'count_tipo_sede': return "COUNT({$t}.tipo_sede)";

      case $p.'min_centro_educativo': return "MIN({$t}.centro_educativo)";
      case $p.'max_centro_educativo': return "MAX({$t}.centro_educativo)";
      case $p.'count_centro_educativo': return "COUNT({$t}.centro_educativo)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.numero, {$t}.nombre)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'dom')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('tipo_sede', 'ts')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('centro_educativo', 'ce')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'ce_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio, ' . $this->_mappingField($p.'tipo_sede') . ' AS ' . $p.'tipo_sede, ' . $this->_mappingField($p.'centro_educativo') . ' AS ' . $p.'centro_educativo';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'domicilio') . ', ' . $this->_mappingField($p.'tipo_sede') . ', ' . $this->_mappingField($p.'centro_educativo') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('domicilio', 'dom')->_fields() . ',
' . $this->container->getSql('tipo_sede', 'ts')->_fields() . ',
' . $this->container->getSql('centro_educativo', 'ce')->_fields() . ',
' . $this->container->getSql('domicilio', 'ce_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('domicilio', 'dom')->_join('domicilio', 'sede', $render) . '
' . $this->container->getSql('tipo_sede', 'ts')->_join('tipo_sede', 'sede', $render) . '
' . $this->container->getSql('centro_educativo', 'ce')->_join('centro_educativo', 'sede', $render) . '
' . $this->container->getSql('domicilio', 'ce_dom')->_join('domicilio', 'ce', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}numero": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero"), $value, $option);

      case "{$p}nombre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombre"), $value, $option);

      case "{$p}observaciones": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}observaciones_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}observaciones"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}baja": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}baja_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}baja_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}baja"), $value, $option);

      case "{$p}domicilio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}domicilio"), $value, $option);

      case "{$p}tipo_sede": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}tipo_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}tipo_sede"), $value, $option);

      case "{$p}centro_educativo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}centro_educativo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}centro_educativo"), $value, $option);


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


      case "{$p}max_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombre"), $value, $option);

      case "{$p}min_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombre"), $value, $option);

      case "{$p}count_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombre"), $value, $option);


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


      case "{$p}avg_baja": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_baja_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_baja"), $value, $option);

      case "{$p}max_baja": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_baja_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_baja"), $value, $option);

      case "{$p}min_baja": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_baja_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_baja"), $value, $option);

      case "{$p}count_baja": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_baja_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_baja"), $value, $option);


      case "{$p}max_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_domicilio"), $value, $option);

      case "{$p}min_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_domicilio"), $value, $option);

      case "{$p}count_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_domicilio"), $value, $option);


      case "{$p}max_tipo_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_tipo_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_tipo_sede"), $value, $option);

      case "{$p}min_tipo_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_tipo_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_tipo_sede"), $value, $option);

      case "{$p}count_tipo_sede": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_tipo_sede_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_tipo_sede"), $value, $option);


      case "{$p}max_centro_educativo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_centro_educativo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_centro_educativo"), $value, $option);

      case "{$p}min_centro_educativo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_centro_educativo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_centro_educativo"), $value, $option);

      case "{$p}count_centro_educativo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_centro_educativo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_centro_educativo"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('tipo_sede','ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('centro_educativo','ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('numero', $row)) $row_['numero'] = $this->format->string($row['numero']);
    if(array_key_exists('nombre', $row)) $row_['nombre'] = $this->format->string($row['nombre']);
    if(array_key_exists('observaciones', $row)) $row_['observaciones'] = $this->format->string($row['observaciones']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('baja', $row)) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(array_key_exists('domicilio', $row)) $row_['domicilio'] = $this->format->string($row['domicilio']);
    if(array_key_exists('tipo_sede', $row)) $row_['tipo_sede'] = $this->format->string($row['tipo_sede']);
    if(array_key_exists('centro_educativo', $row)) $row_['centro_educativo'] = $this->format->string($row['centro_educativo']);

    return $row_;
  }


}
