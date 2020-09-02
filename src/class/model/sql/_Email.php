<?php
require_once("class/model/Sql.php");

class _EmailSql extends EntitySql{

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'email': return $t.".email";
      case $p.'verificado': return $t.".verificado";
      case $p.'insertado': return $t.".insertado";
      case $p.'insertado_date': return "CAST({$t}.insertado AS DATE)";
      case $p.'eliminado': return $t.".eliminado";
      case $p.'eliminado_date': return "CAST({$t}.eliminado AS DATE)";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_email': return "MIN({$t}.email)";
      case $p.'max_email': return "MAX({$t}.email)";
      case $p.'count_email': return "COUNT({$t}.email)";

      case $p.'min_verificado': return "MIN({$t}.verificado)";
      case $p.'max_verificado': return "MAX({$t}.verificado)";
      case $p.'count_verificado': return "COUNT({$t}.verificado)";

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
    if($f = $this->container->getSql('persona', 'per')->_mappingField($field)) return $f;
    if($f = $this->container->getSql('domicilio', 'per_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'verificado') . ' AS ' . $p.'verificado, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado, ' . $this->_mappingField($p.'eliminado') . ' AS ' . $p.'eliminado, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'verificado') . ', ' . $this->_mappingField($p.'insertado') . ', ' . $this->_mappingField($p.'eliminado') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . $this->container->getSql('persona', 'per')->_fields() . ',
' . $this->container->getSql('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return $this->container->getSql('persona', 'per')->_join('persona', 'emai', $render) . '
' . $this->container->getSql('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}email": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}email"), $value, $option);

      case "{$p}verificado": return $this->format->conditionBoolean($this->_mappingField($field), $value);
    case "{$p}verificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}verificado"), $value, $option);

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


      case "{$p}max_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_email"), $value, $option);

      case "{$p}min_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_email"), $value, $option);

      case "{$p}count_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_email"), $value, $option);


      case "{$p}max_verificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_verificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_verificado"), $value, $option);

      case "{$p}min_verificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_verificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_verificado"), $value, $option);

      case "{$p}count_verificado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_verificado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_verificado"), $value, $option);


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
    if($c = $this->container->getSql('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','per_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = $this->container->getSql('domicilio','per_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('email', $row)) $row_['email'] = $this->format->string($row['email']);
    if(array_key_exists('verificado', $row)) $row_['verificado'] = $this->format->boolean($row['verificado']);
    if(array_key_exists('insertado', $row)) $row_['insertado'] = $this->format->timestamp($row['insertado']);
    if(array_key_exists('eliminado', $row)) $row_['eliminado'] = $this->format->timestamp($row['eliminado']);
    if(array_key_exists('persona', $row)) $row_['persona'] = $this->format->string($row['persona']);

    return $row_;
  }


}
