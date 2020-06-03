<?php
require_once("class/model/Sql.php");

class _CursoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('curso');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'alta': return $t.".alta";
      case $p.'comision': return $t.".comision";
      case $p.'asignatura': return $t.".asignatura";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case $p.'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case $p.'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case $p.'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case $p.'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_comision': return "MIN({$t}.comision)";
      case $p.'max_comision': return "MAX({$t}.comision)";
      case $p.'count_comision': return "COUNT({$t}.comision)";

      case $p.'min_asignatura': return "MIN({$t}.asignatura)";
      case $p.'max_asignatura': return "MAX({$t}.asignatura)";
      case $p.'count_asignatura': return "COUNT({$t}.asignatura)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'comision') . ' AS ' . $p.'comision, ' . $this->_mappingField($p.'asignatura') . ' AS ' . $p.'asignatura';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'horas_catedra') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'comision') . ', ' . $this->_mappingField($p.'asignatura') . '';
  }

  public function fields(){
    return $this->_fields() . ' 
';
  }

;ublic function join(Render $render){
    return 
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}comision": return $this->format->conditionText($f, $value, $option);
      case "{$p}asignatura": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_horas_catedra": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_alta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_comision": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_comision": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_comision": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_asignatura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_asignatura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_asignatura": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('curso');
    if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra');
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['comision'])) throw new Exception('dato obligatorio sin valor: comision');
    if(empty($data['asignatura'])) throw new Exception('dato obligatorio sin valor: asignatura');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('horas_catedra', $data)) { if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra'); }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('comision', $data)) { if(!isset($data['comision']) || ($data['comision'] == '')) throw new Exception('dato obligatorio sin valor: comision'); }
    if(array_key_exists('asignatura', $data)) { if(!isset($data['asignatura']) || ($data['asignatura'] == '')) throw new Exception('dato obligatorio sin valor: asignatura'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['horas_catedra'])) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['comision'])) $row_['comision'] = $this->format->escapeString($row['comision']);
    if(isset($row['asignatura'])) $row_['asignatura'] = $this->format->escapeString($row['asignatura']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["horas_catedra"] = (is_null($row[$prefix . "horas_catedra"])) ? null : intval($row[$prefix . "horas_catedra"]);
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["comision"] = (is_null($row[$prefix . "comision"])) ? null : (string)$row[$prefix . "comision"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["asignatura"] = (is_null($row[$prefix . "asignatura"])) ? null : (string)$row[$prefix . "asignatura"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
