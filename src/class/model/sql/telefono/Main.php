<?php
require_once("class/model/Sql.php");

class TelefonoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('telefono');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'prefijo': return $t.".prefijo";
      case $p.'numero': return $t.".numero";
      case $p.'tipo': return $t.".tipo";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'persona': return $t.".persona";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_prefijo': return "SUM({$t}.prefijo)";
      case $p.'avg_prefijo': return "AVG({$t}.prefijo)";
      case $p.'min_prefijo': return "MIN({$t}.prefijo)";
      case $p.'max_prefijo': return "MAX({$t}.prefijo)";
      case $p.'count_prefijo': return "COUNT({$t}.prefijo)";

      case $p.'sum_numero': return "SUM({$t}.numero)";
      case $p.'avg_numero': return "AVG({$t}.numero)";
      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'per')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'prefijo') . ' AS ' . $p.'prefijo, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'tipo') . ' AS ' . $p.'tipo, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'prefijo') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'tipo') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'per')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('id_persona', 'per')->_join('persona', 'tele', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}prefijo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}tipo": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}persona": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('telefono');
    if(!isset($data['prefijo']) || ($data['prefijo'] == '')) throw new Exception('dato obligatorio sin valor: prefijo');
    if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero');
    if(empty($data['tipo'])) throw new Exception('dato obligatorio sin valor: tipo');
    if(!isset($data['baja']))  $data['baja'] = "null";
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('prefijo', $data)) { if(!isset($data['prefijo']) || ($data['prefijo'] == '')) throw new Exception('dato obligatorio sin valor: prefijo'); }
    if(array_key_exists('numero', $data)) { if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('tipo', $data)) { if(empty($data['tipo'])) throw new Exception('dato obligatorio sin valor: tipo'); }
    if(array_key_exists('baja', $data)) { if(empty($data['baja']))  $data['baja'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['prefijo'])) $row_['prefijo'] = $this->format->numeric($row['prefijo']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->numeric($row['numero']);
    if(isset($row['tipo'])) $row_['tipo'] = $this->format->escapeString($row['tipo']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['persona']) ) $row_['persona'] = $this->format->positiveIntegerWithoutZerofill($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["prefijo"] = (is_null($row[$prefix . "prefijo"])) ? null : intval($row[$prefix . "prefijo"]);
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : intval($row[$prefix . "numero"]);
    $row_["tipo"] = (is_null($row[$prefix . "tipo"])) ? null : (string)$row[$prefix . "tipo"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
