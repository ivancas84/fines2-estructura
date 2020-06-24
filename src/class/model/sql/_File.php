<?php
require_once("class/model/Sql.php");

class _FileSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('file');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'name': return $t.".name";
      case $p.'type': return $t.".type";
      case $p.'content': return $t.".content";
      case $p.'size': return $t.".size";
      case $p.'created': return $t.".created";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_name': return "MIN({$t}.name)";
      case $p.'max_name': return "MAX({$t}.name)";
      case $p.'count_name': return "COUNT({$t}.name)";

      case $p.'min_type': return "MIN({$t}.type)";
      case $p.'max_type': return "MAX({$t}.type)";
      case $p.'count_type': return "COUNT({$t}.type)";

      case $p.'min_content': return "MIN({$t}.content)";
      case $p.'max_content': return "MAX({$t}.content)";
      case $p.'count_content': return "COUNT({$t}.content)";

      case $p.'sum_size': return "SUM({$t}.size)";
      case $p.'avg_size': return "AVG({$t}.size)";
      case $p.'min_size': return "MIN({$t}.size)";
      case $p.'max_size': return "MAX({$t}.size)";
      case $p.'count_size': return "COUNT({$t}.size)";

      case $p.'avg_created': return "AVG({$t}.created)";
      case $p.'min_created': return "MIN({$t}.created)";
      case $p.'max_created': return "MAX({$t}.created)";
      case $p.'count_created': return "COUNT({$t}.created)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.name
)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'name') . ' AS ' . $p.'name, ' . $this->_mappingField($p.'type') . ' AS ' . $p.'type, ' . $this->_mappingField($p.'content') . ' AS ' . $p.'content, ' . $this->_mappingField($p.'size') . ' AS ' . $p.'size, ' . $this->_mappingField($p.'created') . ' AS ' . $p.'created';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'name') . ', ' . $this->_mappingField($p.'type') . ', ' . $this->_mappingField($p.'content') . ', ' . $this->_mappingField($p.'size') . ', ' . $this->_mappingField($p.'created') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}name": return $this->format->conditionText($f, $value, $option);
      case "{$p}type": return $this->format->conditionText($f, $value, $option);
      case "{$p}content": return $this->format->conditionText($f, $value, $option);
      case "{$p}size": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}created": return $this->format->conditionTimestamp($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_name": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_name": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_name": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_type": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_type": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_type": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_content": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_content": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_content": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_size": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_size": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_size": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_size": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_size": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_created": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_created": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_created": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_created": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('file');
    if(!isset($data['name']) || is_null($data['name']) || $data['name'] == "") throw new Exception('dato obligatorio sin valor: name');
    if(!isset($data['type']) || is_null($data['type']) || $data['type'] == "") throw new Exception('dato obligatorio sin valor: type');
    if(!isset($data['content']) || is_null($data['content']) || $data['content'] == "") throw new Exception('dato obligatorio sin valor: content');
    if(!isset($data['size']) || ($data['size'] == '')) throw new Exception('dato obligatorio sin valor: size');
    if(!isset($data['created']))  $data['created'] = date("Y-m-d H:i:s");

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('name', $data)) { if(is_null($data['name']) || $data['name'] == "") throw new Exception('dato obligatorio sin valor: name'); }
    if(array_key_exists('type', $data)) { if(is_null($data['type']) || $data['type'] == "") throw new Exception('dato obligatorio sin valor: type'); }
    if(array_key_exists('content', $data)) { if(is_null($data['content']) || $data['content'] == "") throw new Exception('dato obligatorio sin valor: content'); }
    if(array_key_exists('size', $data)) { if(!isset($data['size']) || ($data['size'] == '')) throw new Exception('dato obligatorio sin valor: size'); }
    if(array_key_exists('created', $data)) { if(empty($data['created']))  $data['created'] = date("Y-m-d H:i:s"); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['name'])) $row_['name'] = $this->format->escapeString($row['name']);
    if(isset($row['type'])) $row_['type'] = $this->format->escapeString($row['type']);
    if(isset($row['content'])) $row_['content'] = $this->format->escapeString($row['content']);
    if(isset($row['size'])) $row_['size'] = $this->format->numeric($row['size']);
    if(isset($row['created'])) $row_['created'] = $this->format->timestamp($row['created']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["name"] = (is_null($row[$prefix . "name"])) ? null : (string)$row[$prefix . "name"];
    $row_["type"] = (is_null($row[$prefix . "type"])) ? null : (string)$row[$prefix . "type"];
    $row_["content"] = (is_null($row[$prefix . "content"])) ? null : (string)$row[$prefix . "content"];
    $row_["size"] = (is_null($row[$prefix . "size"])) ? null : intval($row[$prefix . "size"]);
    $row_["created"] = (is_null($row[$prefix . "created"])) ? null : (string)$row[$prefix . "created"];
    return $row_;
  }



}
