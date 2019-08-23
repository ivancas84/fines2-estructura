<?php
require_once("class/model/Sql.php");

class DistribucionHorariaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('distribucion_horaria');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'dia': return $t.".dia";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'carga_horaria': return $t.".carga_horaria";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'sum_dia': return "SUM({$t}.dia)";
      case 'avg_dia': return "AVG({$t}.dia)";
      case 'min_dia': return "MIN({$t}.dia)";
      case 'max_dia': return "MAX({$t}.dia)";
      case 'count_dia': return "COUNT({$t}.dia)";

      case 'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case 'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case 'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case 'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case 'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case 'min_carga_horaria': return "MIN({$t}.carga_horaria)";
      case 'max_carga_horaria': return "MAX({$t}.carga_horaria)";
      case 'count_carga_horaria': return "COUNT({$t}.carga_horaria)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('carga_horaria', 'ch')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'ch_pla')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia, ' . $this->_mappingField($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingField($p.'carga_horaria') . ' AS ' . $p.'carga_horaria';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'dia') . ', ' . $this->_mappingField($p.'horas_catedra') . ', ' . $this->_mappingField($p.'carga_horaria') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('carga_horaria', 'ch')->_fields() . ',
' . EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'ch_pla')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('carga_horaria', 'ch')->_join('carga_horaria', 'dh', $render) . '
' . EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_join('asignatura', 'ch', $render) . '
' . EntitySql::getInstanceRequire('plan', 'ch_pla')->_join('plan', 'ch', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}carga_horaria": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','ch')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','ch_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','ch_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','ch')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','ch_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','ch_pla')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('distribucion_horaria');
    if(!isset($data['dia']) || ($data['dia'] == '')) throw new Exception('dato obligatorio sin valor: dia');
    if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra');
    if(empty($data['carga_horaria'])) throw new Exception('dato obligatorio sin valor: carga_horaria');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('dia', $data)) { if(!isset($data['dia']) || ($data['dia'] == '')) throw new Exception('dato obligatorio sin valor: dia'); }
    if(array_key_exists('horas_catedra', $data)) { if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra'); }
    if(array_key_exists('carga_horaria', $data)) { if(!isset($data['carga_horaria']) || ($data['carga_horaria'] == '')) throw new Exception('dato obligatorio sin valor: carga_horaria'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['dia'])) $row_['dia'] = $this->format->numeric($row['dia']);
    if(isset($row['horas_catedra'])) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(isset($row['carga_horaria']) ) $row_['carga_horaria'] = $this->format->positiveIntegerWithoutZerofill($row['carga_horaria']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["dia"] = (is_null($row[$prefix . "dia"])) ? null : intval($row[$prefix . "dia"]);
    $row_["horas_catedra"] = (is_null($row[$prefix . "horas_catedra"])) ? null : intval($row[$prefix . "horas_catedra"]);
    $row_["carga_horaria"] = (is_null($row[$prefix . "carga_horaria"])) ? null : (string)$row[$prefix . "carga_horaria"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
