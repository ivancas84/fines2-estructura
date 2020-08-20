<?php
require_once("class/model/Sql.php");

class _DetallePersonaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('detalle_persona');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'descripcion': return $t.".descripcion";
      case $p.'creado': return $t.".creado";
      case $p.'creado_date': return "CAST({$t}.creado AS DATE)";
      case $p.'archivo': return $t.".archivo";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_descripcion': return "MIN({$t}.descripcion)";
      case $p.'max_descripcion': return "MAX({$t}.descripcion)";
      case $p.'count_descripcion': return "COUNT({$t}.descripcion)";

      case $p.'avg_creado': return "AVG({$t}.creado)";
      case $p.'min_creado': return "MIN({$t}.creado)";
      case $p.'max_creado': return "MAX({$t}.creado)";
      case $p.'count_creado': return "COUNT({$t}.creado)";

      case $p.'min_archivo': return "MIN({$t}.archivo)";
      case $p.'max_archivo': return "MAX({$t}.archivo)";
      case $p.'count_archivo': return "COUNT({$t}.archivo)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.id)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('file', 'arc')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'per')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'per_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'descripcion') . ' AS ' . $p.'descripcion, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'archivo') . ' AS ' . $p.'archivo, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'descripcion') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'archivo') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('file', 'arc')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('file', 'arc')->_join('archivo', 'dp', $render) . '
' . EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'dp', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}descripcion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}descripcion"), $value, $option);

      case "{$p}creado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}creado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}creado"), $value, $option);

      case "{$p}archivo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}archivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}archivo"), $value, $option);

      case "{$p}persona": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}persona_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}persona"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_descripcion"), $value, $option);

      case "{$p}min_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_descripcion"), $value, $option);

      case "{$p}count_descripcion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_descripcion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_descripcion"), $value, $option);


      case "{$p}avg_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_creado"), $value, $option);

      case "{$p}max_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_creado"), $value, $option);

      case "{$p}min_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_creado"), $value, $option);

      case "{$p}count_creado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_creado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_creado"), $value, $option);


      case "{$p}max_archivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_archivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_archivo"), $value, $option);

      case "{$p}min_archivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_archivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_archivo"), $value, $option);

      case "{$p}count_archivo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_archivo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_archivo"), $value, $option);


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
    if($c = EntitySql::getInstanceRequire('file','arc')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('file','arc')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('descripcion', $row)) $row_['descripcion'] = $this->format->string($row['descripcion']);
    if(array_key_exists('creado', $row)) $row_['creado'] = $this->format->timestamp($row['creado']);
    if(array_key_exists('archivo', $row)) $row_['archivo'] = $this->format->string($row['archivo']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }


}
