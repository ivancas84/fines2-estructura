<?php
require_once("class/model/Sql.php");

class DiaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('dia');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'dia': return $t.".dia";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'sum_numero': return "SUM({$t}.numero)";
      case 'avg_numero': return "AVG({$t}.numero)";
      case 'min_numero': return "MIN({$t}.numero)";
      case 'max_numero': return "MAX({$t}.numero)";
      case 'count_numero': return "COUNT({$t}.numero)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingFieldEntity($p.'dia') . ' AS ' . $p.'dia';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'numero') . ', ' . $this->_mappingFieldEntity($p.'dia') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}dia": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('dia');
    if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero');
    if(empty($data['dia'])) throw new Exception('dato obligatorio sin valor: dia');

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('numero', $data)) { if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('dia', $data)) { if(empty($data['dia'])) throw new Exception('dato obligatorio sin valor: dia'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->numeric($row['numero']);
    if(isset($row['dia'])) $row_['dia'] = $this->format->escapeString($row['dia']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : intval($row[$prefix . "numero"]);
    $row_["dia"] = (is_null($row[$prefix . "dia"])) ? null : (string)$row[$prefix . "dia"];
    return $row_;
  }



}
