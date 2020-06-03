<?php
require_once("class/model/Sql.php");

class _DiaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('dia');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'dia': return $t.".dia";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_numero': return "SUM({$t}.numero)";
      case $p.'avg_numero': return "AVG({$t}.numero)";
      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'min_dia': return "MIN({$t}.dia)";
      case $p.'max_dia': return "MAX({$t}.dia)";
      case $p.'count_dia': return "COUNT({$t}.dia)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'dia') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}dia": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_numero": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_dia": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('dia');
    if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero');
    if(!isset($data['dia']) || is_null($data['dia']) || $data['dia'] == "") throw new Exception('dato obligatorio sin valor: dia');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('numero', $data)) { if(!isset($data['numero']) || ($data['numero'] == '')) throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('dia', $data)) { if(is_null($data['dia']) || $data['dia'] == "") throw new Exception('dato obligatorio sin valor: dia'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
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
