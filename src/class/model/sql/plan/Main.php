<?php
require_once("class/model/Sql.php");

class PlanSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('plan');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'orientacion': return $t.".orientacion";
      case $p.'resolucion': return $t.".resolucion";
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
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'orientacion') . ' AS ' . $p.'orientacion, ' . $this->_mappingFieldEntity($p.'resolucion') . ' AS ' . $p.'resolucion';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'orientacion') . ', ' . $this->_mappingFieldEntity($p.'resolucion') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}orientacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}resolucion": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('plan');
    if(empty($data['orientacion'])) throw new Exception('dato obligatorio sin valor: orientacion');
    if(empty($data['resolucion'])) $data['resolucion'] = "null";

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('orientacion', $data)) { if(empty($data['orientacion'])) throw new Exception('dato obligatorio sin valor: orientacion'); }
    if(array_key_exists('resolucion', $data)) { if(empty($data['resolucion'])) $data['resolucion'] = "null"; }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['orientacion'])) $row_['orientacion'] = $this->format->escapeString($row['orientacion']);
    if(isset($row['resolucion'])) $row_['resolucion'] = $this->format->escapeString($row['resolucion']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["orientacion"] = (is_null($row[$prefix . "orientacion"])) ? null : (string)$row[$prefix . "orientacion"];
    $row_["resolucion"] = (is_null($row[$prefix . "resolucion"])) ? null : (string)$row[$prefix . "resolucion"];
    return $row_;
  }



}
