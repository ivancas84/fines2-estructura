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
      case $p.'fecha_nacimiento': return $t.".fecha_nacimiento";
      case $p.'numero_documento': return $t.".numero_documento";
      case $p.'cuil': return $t.".cuil";
      case $p.'email': return $t.".email";
      case $p.'genero': return $t.".genero";
      case $p.'apodo': return $t.".apodo";
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

      case $p.'avg_fecha_nacimiento': return "AVG({$t}.fecha_nacimiento)";
      case $p.'min_fecha_nacimiento': return "MIN({$t}.fecha_nacimiento)";
      case $p.'max_fecha_nacimiento': return "MAX({$t}.fecha_nacimiento)";
      case $p.'count_fecha_nacimiento': return "COUNT({$t}.fecha_nacimiento)";

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
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingField($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingField($p.'fecha_nacimiento') . ' AS ' . $p.'fecha_nacimiento, ' . $this->_mappingField($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingField($p.'cuil') . ' AS ' . $p.'cuil, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'genero') . ' AS ' . $p.'genero, ' . $this->_mappingField($p.'apodo') . ' AS ' . $p.'apodo, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombres') . ', ' . $this->_mappingField($p.'apellidos') . ', ' . $this->_mappingField($p.'fecha_nacimiento') . ', ' . $this->_mappingField($p.'numero_documento') . ', ' . $this->_mappingField($p.'cuil') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'genero') . ', ' . $this->_mappingField($p.'apodo') . ', ' . $this->_mappingField($p.'alta') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombres": return $this->format->conditionText($f, $value, $option);
      case "{$p}apellidos": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_nacimiento": return $this->format->conditionDate($f, $value, $option);
      case "{$p}numero_documento": return $this->format->conditionText($f, $value, $option);
      case "{$p}cuil": return $this->format->conditionText($f, $value, $option);
      case "{$p}email": return $this->format->conditionText($f, $value, $option);
      case "{$p}genero": return $this->format->conditionText($f, $value, $option);
      case "{$p}apodo": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('persona');
    if(!isset($data['nombres']) || is_null($data['nombres']) || $data['nombres'] == "") throw new Exception('dato obligatorio sin valor: nombres');
    if(!isset($data['apellidos']) || is_null($data['apellidos']) || $data['apellidos'] == "") $data['apellidos'] = "null";
    if(!isset($data['fecha_nacimiento']))  $data['fecha_nacimiento'] = "null";
    if(!isset($data['numero_documento']) || is_null($data['numero_documento']) || $data['numero_documento'] == "") throw new Exception('dato obligatorio sin valor: numero_documento');
    if(!isset($data['cuil']) || is_null($data['cuil']) || $data['cuil'] == "") $data['cuil'] = "null";
    if(!isset($data['email']) || is_null($data['email']) || $data['email'] == "") $data['email'] = "null";
    if(!isset($data['genero']) || is_null($data['genero']) || $data['genero'] == "") $data['genero'] = "null";
    if(!isset($data['apodo']) || is_null($data['apodo']) || $data['apodo'] == "") $data['apodo'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('nombres', $data)) { if(is_null($data['nombres']) || $data['nombres'] == "") throw new Exception('dato obligatorio sin valor: nombres'); }
    if(array_key_exists('apellidos', $data)) { if(is_null($data['apellidos']) || $data['apellidos'] == "") $data['apellidos'] = "null"; }
    if(array_key_exists('fecha_nacimiento', $data)) { if(empty($data['fecha_nacimiento']))  $data['fecha_nacimiento'] = "null"; }
    if(array_key_exists('numero_documento', $data)) { if(is_null($data['numero_documento']) || $data['numero_documento'] == "") throw new Exception('dato obligatorio sin valor: numero_documento'); }
    if(array_key_exists('cuil', $data)) { if(is_null($data['cuil']) || $data['cuil'] == "") $data['cuil'] = "null"; }
    if(array_key_exists('email', $data)) { if(is_null($data['email']) || $data['email'] == "") $data['email'] = "null"; }
    if(array_key_exists('genero', $data)) { if(is_null($data['genero']) || $data['genero'] == "") $data['genero'] = "null"; }
    if(array_key_exists('apodo', $data)) { if(is_null($data['apodo']) || $data['apodo'] == "") $data['apodo'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['nombres'])) $row_['nombres'] = $this->format->escapeString($row['nombres']);
    if(isset($row['apellidos'])) $row_['apellidos'] = $this->format->escapeString($row['apellidos']);
    if(isset($row['fecha_nacimiento'])) $row_['fecha_nacimiento'] = $this->format->date($row['fecha_nacimiento']);
    if(isset($row['numero_documento'])) $row_['numero_documento'] = $this->format->escapeString($row['numero_documento']);
    if(isset($row['cuil'])) $row_['cuil'] = $this->format->escapeString($row['cuil']);
    if(isset($row['email'])) $row_['email'] = $this->format->escapeString($row['email']);
    if(isset($row['genero'])) $row_['genero'] = $this->format->escapeString($row['genero']);
    if(isset($row['apodo'])) $row_['apodo'] = $this->format->escapeString($row['apodo']);
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
    $row_["fecha_nacimiento"] = (is_null($row[$prefix . "fecha_nacimiento"])) ? null : (string)$row[$prefix . "fecha_nacimiento"];
    $row_["numero_documento"] = (is_null($row[$prefix . "numero_documento"])) ? null : (string)$row[$prefix . "numero_documento"];
    $row_["cuil"] = (is_null($row[$prefix . "cuil"])) ? null : (string)$row[$prefix . "cuil"];
    $row_["email"] = (is_null($row[$prefix . "email"])) ? null : (string)$row[$prefix . "email"];
    $row_["genero"] = (is_null($row[$prefix . "genero"])) ? null : (string)$row[$prefix . "genero"];
    $row_["apodo"] = (is_null($row[$prefix . "apodo"])) ? null : (string)$row[$prefix . "apodo"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    return $row_;
  }



}
