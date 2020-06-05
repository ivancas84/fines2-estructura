<?php
require_once("class/model/Sql.php");

class _EmailSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('email');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'email': return $t.".email";
      case $p.'verificado': return $t.".verificado";
      case $p.'insertado': return $t.".insertado";
      case $p.'eliminado': return $t.".eliminado";
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
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'verificado') . ' AS ' . $p.'verificado, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado, ' . $this->_mappingField($p.'eliminado') . ' AS ' . $p.'eliminado, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'verificado') . ', ' . $this->_mappingField($p.'insertado') . ', ' . $this->_mappingField($p.'eliminado') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'emai', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}email": return $this->format->conditionText($f, $value, $option);
      case "{$p}verificado": return $this->format->conditionBoolean($f, $value);
      case "{$p}insertado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}eliminado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}persona": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_email": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_email": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_email": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_verificado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_verificado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_verificado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_insertado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_eliminado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_eliminado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_persona": return $this->format->conditionNumber($f, $value, $option);

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

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('email');
    if(!isset($data['email']) || is_null($data['email']) || $data['email'] == "") throw new Exception('dato obligatorio sin valor: email');
    if(!isset($data['verificado']) || ($data['verificado'] == '')) $data['verificado'] = "false";
    if(!isset($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s");
    if(!isset($data['eliminado']))  $data['eliminado'] = "null";
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('email', $data)) { if(is_null($data['email']) || $data['email'] == "") throw new Exception('dato obligatorio sin valor: email'); }
    if(array_key_exists('verificado', $data)) { if(!isset($data['verificado']) || ($data['verificado'] == '')) $data['verificado'] = "false"; }
    if(array_key_exists('insertado', $data)) { if(empty($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('eliminado', $data)) { if(empty($data['eliminado']))  $data['eliminado'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['email'])) $row_['email'] = $this->format->escapeString($row['email']);
    if(isset($row['verificado'])) $row_['verificado'] = $this->format->boolean($row['verificado']);
    if(isset($row['insertado'])) $row_['insertado'] = $this->format->timestamp($row['insertado']);
    if(isset($row['eliminado'])) $row_['eliminado'] = $this->format->timestamp($row['eliminado']);
    if(isset($row['persona'])) $row_['persona'] = $this->format->escapeString($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["email"] = (is_null($row[$prefix . "email"])) ? null : (string)$row[$prefix . "email"];
    $row_["verificado"] = (is_null($row[$prefix . "verificado"])) ? null : settypebool($row[$prefix . "verificado"]);
    $row_["insertado"] = (is_null($row[$prefix . "insertado"])) ? null : (string)$row[$prefix . "insertado"];
    $row_["eliminado"] = (is_null($row[$prefix . "eliminado"])) ? null : (string)$row[$prefix . "eliminado"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
