<?php
require_once("class/model/Sql.php");

class _PlanillaDocenteSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('planilla_docente');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'insertado': return $t.".insertado";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.numero
)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'insertado') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero": return $this->format->conditionText($f, $value, $option);
      case "{$p}insertado": return $this->format->conditionTimestamp($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_numero": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_insertado": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('planilla_docente');
    if(!isset($data['numero']) || is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero');
    if(!isset($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s");

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('numero', $data)) { if(is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('insertado', $data)) { if(empty($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s"); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->escapeString($row['numero']);
    if(isset($row['insertado'])) $row_['insertado'] = $this->format->timestamp($row['insertado']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : (string)$row[$prefix . "numero"];
    $row_["insertado"] = (is_null($row[$prefix . "insertado"])) ? null : (string)$row[$prefix . "insertado"];
    return $row_;
  }



}
