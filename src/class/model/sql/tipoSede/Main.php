<?php
require_once("class/model/Sql.php");

class TipoSedeSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('tipo_sede');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'descripcion': return $t.".descripcion";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'descripcion') . ' AS ' . $p.'descripcion';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'descripcion') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}descripcion": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('tipo_sede');
    if(empty($data['descripcion'])) throw new Exception('dato obligatorio sin valor: descripcion');

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('descripcion', $data)) { if(empty($data['descripcion'])) throw new Exception('dato obligatorio sin valor: descripcion'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['descripcion'])) $row_['descripcion'] = $this->format->escapeString($row['descripcion']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["descripcion"] = (is_null($row[$prefix . "descripcion"])) ? null : (string)$row[$prefix . "descripcion"];
    return $row_;
  }



}
