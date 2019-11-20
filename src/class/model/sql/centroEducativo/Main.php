<?php
require_once("class/model/Sql.php");

class CentroEducativoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('centro_educativo');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombre': return $t.".nombre";
      case $p.'cue': return $t.".cue";
      case $p.'domicilio': return $t.".domicilio";
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

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'cue') . ' AS ' . $p.'cue, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
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

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombre": return $this->format->conditionText($f, $value, $option);
      case "{$p}cue": return $this->format->conditionText($f, $value, $option);
      case "{$p}domicilio": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
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

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('centro_educativo');
    if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre');
    if(empty($data['cue'])) $data['cue'] = "null";
    if(empty($data['domicilio'])) throw new Exception('dato obligatorio sin valor: domicilio');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(empty($data['id'])) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('nombre', $data)) { if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre'); }
    if(array_key_exists('cue', $data)) { if(empty($data['cue'])) $data['cue'] = "null"; }
    if(array_key_exists('domicilio', $data)) { if(!isset($data['domicilio']) || ($data['domicilio'] == '')) throw new Exception('dato obligatorio sin valor: domicilio'); }

    return $data;
  }

  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['nombre'])) $row_['nombre'] = $this->format->escapeString($row['nombre']);
    if(isset($row['cue'])) $row_['cue'] = $this->format->escapeString($row['cue']);
    if(isset($row['domicilio'])) $row_['domicilio'] = $this->format->escapeString($row['domicilio']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nombre"] = (is_null($row[$prefix . "nombre"])) ? null : (string)$row[$prefix . "nombre"];
    $row_["cue"] = (is_null($row[$prefix . "cue"])) ? null : (string)$row[$prefix . "cue"];
    $row_["domicilio"] = (is_null($row[$prefix . "domicilio"])) ? null : (string)$row[$prefix . "domicilio"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
