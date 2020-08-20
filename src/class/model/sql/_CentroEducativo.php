<?php
require_once("class/model/Sql.php");

class _CentroEducativoSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('centro_educativo');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombre': return $t.".nombre";
      case $p.'cue': return $t.".cue";
      case $p.'domicilio': return $t.".domicilio";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_nombre': return "MIN({$t}.nombre)";
      case $p.'max_nombre': return "MAX({$t}.nombre)";
      case $p.'count_nombre': return "COUNT({$t}.nombre)";

      case $p.'min_cue': return "MIN({$t}.cue)";
      case $p.'max_cue': return "MAX({$t}.cue)";
      case $p.'count_cue': return "COUNT({$t}.cue)";

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.nombre)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'cue') . ' AS ' . $p.'cue, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'cue') . ', ' . $this->_mappingField($p.'domicilio') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('domicilio', 'dom')->_join('domicilio', 'ce', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}nombre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombre"), $value, $option);

      case "{$p}cue": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}cue_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}cue"), $value, $option);

      case "{$p}domicilio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}domicilio"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombre"), $value, $option);

      case "{$p}min_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombre"), $value, $option);

      case "{$p}count_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombre"), $value, $option);


      case "{$p}max_cue": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_cue_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_cue"), $value, $option);

      case "{$p}min_cue": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_cue_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_cue"), $value, $option);

      case "{$p}count_cue": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_cue_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_cue"), $value, $option);


      case "{$p}max_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_domicilio"), $value, $option);

      case "{$p}min_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_domicilio"), $value, $option);

      case "{$p}count_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_domicilio"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('nombre', $row)) $row_['nombre'] = $this->format->string($row['nombre']);
    if(array_key_exists('cue', $row)) $row_['cue'] = $this->format->string($row['cue']);
    if(array_key_exists('domicilio', $row)) $row_['domicilio'] = $this->format->string($row['domicilio']);

    return $row_;
  }


}
