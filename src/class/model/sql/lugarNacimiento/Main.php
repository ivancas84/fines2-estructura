<?php
require_once("class/model/Sql.php");

class LugarNacimientoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('lugar_nacimiento');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'ciudad': return $t.".ciudad";
      case $p.'provincia': return $t.".provincia";
      case $p.'pais': return $t.".pais";
      case $p.'alta': return $t.".alta";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'avg_alta': return "AVG({$t}.alta)";
      case 'min_alta': return "MIN({$t}.alta)";
      case 'max_alta': return "MAX({$t}.alta)";
      case 'count_alta': return "COUNT({$t}.alta)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'ciudad') . ' AS ' . $p.'ciudad, ' . $this->_mappingFieldEntity($p.'provincia') . ' AS ' . $p.'provincia, ' . $this->_mappingFieldEntity($p.'pais') . ' AS ' . $p.'pais, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'ciudad') . ', ' . $this->_mappingFieldEntity($p.'provincia') . ', ' . $this->_mappingFieldEntity($p.'pais') . ', ' . $this->_mappingFieldEntity($p.'alta') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}ciudad": return $this->format->conditionText($f, $value, $option);
      case "{$p}provincia": return $this->format->conditionText($f, $value, $option);
      case "{$p}pais": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('lugar_nacimiento');
    if(empty($data['ciudad'])) $data['ciudad'] = "null";
    if(empty($data['provincia'])) $data['provincia'] = "null";
    if(empty($data['pais'])) $data['pais'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('ciudad', $data)) { if(empty($data['ciudad'])) $data['ciudad'] = "null"; }
    if(array_key_exists('provincia', $data)) { if(empty($data['provincia'])) $data['provincia'] = "null"; }
    if(array_key_exists('pais', $data)) { if(empty($data['pais'])) $data['pais'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['ciudad'])) $row_['ciudad'] = $this->format->escapeString($row['ciudad']);
    if(isset($row['provincia'])) $row_['provincia'] = $this->format->escapeString($row['provincia']);
    if(isset($row['pais'])) $row_['pais'] = $this->format->escapeString($row['pais']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["ciudad"] = (is_null($row[$prefix . "ciudad"])) ? null : (string)$row[$prefix . "ciudad"];
    $row_["provincia"] = (is_null($row[$prefix . "provincia"])) ? null : (string)$row[$prefix . "provincia"];
    $row_["pais"] = (is_null($row[$prefix . "pais"])) ? null : (string)$row[$prefix . "pais"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    return $row_;
  }



}
