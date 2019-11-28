<?php
require_once("class/model/Sql.php");

class PersonaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('persona');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombres': return $t.".nombres";
      case $p.'apellidos': return $t.".apellidos";
      case $p.'apodo': return $t.".apodo";
      case $p.'numero_documento': return $t.".numero_documento";
      case $p.'cuil': return $t.".cuil";
      case $p.'email': return $t.".email";
      case $p.'genero': return $t.".genero";
      case $p.'alta': return $t.".alta";
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

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingField($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingField($p.'apodo') . ' AS ' . $p.'apodo, ' . $this->_mappingField($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingField($p.'cuil') . ' AS ' . $p.'cuil, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'genero') . ' AS ' . $p.'genero, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombres') . ', ' . $this->_mappingField($p.'apellidos') . ', ' . $this->_mappingField($p.'apodo') . ', ' . $this->_mappingField($p.'numero_documento') . ', ' . $this->_mappingField($p.'cuil') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'genero') . ', ' . $this->_mappingField($p.'alta') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombres": return $this->format->conditionText($f, $value, $option);
      case "{$p}apellidos": return $this->format->conditionText($f, $value, $option);
      case "{$p}apodo": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero_documento": return $this->format->conditionText($f, $value, $option);
      case "{$p}cuil": return $this->format->conditionText($f, $value, $option);
      case "{$p}email": return $this->format->conditionText($f, $value, $option);
      case "{$p}genero": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('persona');
    if(empty($data['nombres'])) throw new Exception('dato obligatorio sin valor: nombres');
    if(empty($data['apellidos'])) $data['apellidos'] = "null";
    if(empty($data['apodo'])) $data['apodo'] = "null";
    if(empty($data['numero_documento'])) throw new Exception('dato obligatorio sin valor: numero_documento');
    if(empty($data['cuil'])) $data['cuil'] = "null";
    if(empty($data['email'])) $data['email'] = "null";
    if(empty($data['genero'])) $data['genero'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(empty($data['id'])) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('nombres', $data)) { if(empty($data['nombres'])) throw new Exception('dato obligatorio sin valor: nombres'); }
    if(array_key_exists('apellidos', $data)) { if(empty($data['apellidos'])) $data['apellidos'] = "null"; }
    if(array_key_exists('apodo', $data)) { if(empty($data['apodo'])) $data['apodo'] = "null"; }
    if(array_key_exists('numero_documento', $data)) { if(empty($data['numero_documento'])) throw new Exception('dato obligatorio sin valor: numero_documento'); }
    if(array_key_exists('cuil', $data)) { if(empty($data['cuil'])) $data['cuil'] = "null"; }
    if(array_key_exists('email', $data)) { if(empty($data['email'])) $data['email'] = "null"; }
    if(array_key_exists('genero', $data)) { if(empty($data['genero'])) $data['genero'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }

    return $data;
  }

  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['nombres'])) $row_['nombres'] = $this->format->escapeString($row['nombres']);
    if(isset($row['apellidos'])) $row_['apellidos'] = $this->format->escapeString($row['apellidos']);
    if(isset($row['apodo'])) $row_['apodo'] = $this->format->escapeString($row['apodo']);
    if(isset($row['numero_documento'])) $row_['numero_documento'] = $this->format->escapeString($row['numero_documento']);
    if(isset($row['cuil'])) $row_['cuil'] = $this->format->escapeString($row['cuil']);
    if(isset($row['email'])) $row_['email'] = $this->format->escapeString($row['email']);
    if(isset($row['genero'])) $row_['genero'] = $this->format->escapeString($row['genero']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nombres"] = (is_null($row[$prefix . "nombres"])) ? null : (string)$row[$prefix . "nombres"];
    $row_["apellidos"] = (is_null($row[$prefix . "apellidos"])) ? null : (string)$row[$prefix . "apellidos"];
    $row_["apodo"] = (is_null($row[$prefix . "apodo"])) ? null : (string)$row[$prefix . "apodo"];
    $row_["numero_documento"] = (is_null($row[$prefix . "numero_documento"])) ? null : (string)$row[$prefix . "numero_documento"];
    $row_["cuil"] = (is_null($row[$prefix . "cuil"])) ? null : (string)$row[$prefix . "cuil"];
    $row_["email"] = (is_null($row[$prefix . "email"])) ? null : (string)$row[$prefix . "email"];
    $row_["genero"] = (is_null($row[$prefix . "genero"])) ? null : (string)$row[$prefix . "genero"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    return $row_;
  }



}
