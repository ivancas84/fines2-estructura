<?php
require_once("class/model/Sql.php");

class _TelefonoSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('telefono');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'tipo': return $t.".tipo";
      case $p.'prefijo': return $t.".prefijo";
      case $p.'numero': return $t.".numero";
      case $p.'insertado': return $t.".insertado";
      case $p.'insertado_date': return "CAST({$t}.insertado AS DATE)";
      case $p.'eliminado': return $t.".eliminado";
      case $p.'eliminado_date': return "CAST({$t}.eliminado AS DATE)";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_tipo': return "MIN({$t}.tipo)";
      case $p.'max_tipo': return "MAX({$t}.tipo)";
      case $p.'count_tipo': return "COUNT({$t}.tipo)";

      case $p.'min_prefijo': return "MIN({$t}.prefijo)";
      case $p.'max_prefijo': return "MAX({$t}.prefijo)";
      case $p.'count_prefijo': return "COUNT({$t}.prefijo)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'avg_eliminado': return "AVG({$t}.eliminado)";
      case $p.'min_eliminado': return "MIN({$t}.eliminado)";
      case $p.'max_eliminado': return "MAX({$t}.eliminado)";
      case $p.'count_eliminado': return "COUNT({$t}.eliminado)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'per')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'per_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'tipo') . ' AS ' . $p.'tipo, ' . $this->_mappingField($p.'prefijo') . ' AS ' . $p.'prefijo, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado, ' . $this->_mappingField($p.'eliminado') . ' AS ' . $p.'eliminado, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'tipo') . ', ' . $this->_mappingField($p.'prefijo') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'insertado') . ', ' . $this->_mappingField($p.'eliminado') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'tele', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}tipo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}tipo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}tipo"), $value, $option);

      case "{$p}prefijo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}prefijo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}prefijo"), $value, $option);

      case "{$p}numero": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero"), $value, $option);

      case "{$p}insertado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}insertado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}insertado"), $value, $option);

      case "{$p}eliminado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}eliminado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}eliminado"), $value, $option);

      case "{$p}persona": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}persona"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_tipo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_tipo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_tipo"), $value, $option);

      case "{$p}min_tipo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_tipo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_tipo"), $value, $option);

      case "{$p}count_tipo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_tipo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_tipo"), $value, $option);


      case "{$p}max_prefijo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_prefijo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_prefijo"), $value, $option);

      case "{$p}min_prefijo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_prefijo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_prefijo"), $value, $option);

      case "{$p}count_prefijo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_prefijo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_prefijo"), $value, $option);


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


      case "{$p}avg_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_eliminado"), $value, $option);

      case "{$p}max_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_eliminado"), $value, $option);

      case "{$p}min_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_eliminado"), $value, $option);

      case "{$p}count_eliminado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_eliminado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_eliminado"), $value, $option);


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
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('tipo', $row)) $row_['tipo'] = $this->format->string($row['tipo']);
    if(array_key_exists('prefijo', $row)) $row_['prefijo'] = $this->format->string($row['prefijo']);
    if(array_key_exists('numero', $row)) $row_['numero'] = $this->format->string($row['numero']);
    if(array_key_exists('insertado', $row)) $row_['insertado'] = $this->format->timestamp($row['insertado']);
    if(array_key_exists('eliminado', $row)) $row_['eliminado'] = $this->format->timestamp($row['eliminado']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }


}
