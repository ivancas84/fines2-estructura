<?php
require_once("class/model/Sql.php");

class CargaHorariaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('carga_horaria');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'anio': return $t.".anio";
      case $p.'semestre': return $t.".semestre";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'tramo': return $t.".tramo";
      case $p.'asignatura': return $t.".asignatura";
      case $p.'plan': return $t.".plan";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'sum_anio': return "SUM({$t}.anio)";
      case 'avg_anio': return "AVG({$t}.anio)";
      case 'min_anio': return "MIN({$t}.anio)";
      case 'max_anio': return "MAX({$t}.anio)";
      case 'count_anio': return "COUNT({$t}.anio)";

      case 'sum_semestre': return "SUM({$t}.semestre)";
      case 'avg_semestre': return "AVG({$t}.semestre)";
      case 'min_semestre': return "MIN({$t}.semestre)";
      case 'max_semestre': return "MAX({$t}.semestre)";
      case 'count_semestre': return "COUNT({$t}.semestre)";

      case 'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case 'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case 'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case 'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case 'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case 'min_asignatura': return "MIN({$t}.asignatura)";
      case 'max_asignatura': return "MAX({$t}.asignatura)";
      case 'count_asignatura': return "COUNT({$t}.asignatura)";

      case 'min_plan': return "MIN({$t}.plan)";
      case 'max_plan': return "MAX({$t}.plan)";
      case 'count_plan': return "COUNT({$t}.plan)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('asignatura', 'asi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'pla')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'anio') . ' AS ' . $p.'anio, ' . $this->_mappingFieldEntity($p.'semestre') . ' AS ' . $p.'semestre, ' . $this->_mappingFieldEntity($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingFieldEntity($p.'tramo') . ' AS ' . $p.'tramo, ' . $this->_mappingFieldEntity($p.'asignatura') . ' AS ' . $p.'asignatura, ' . $this->_mappingFieldEntity($p.'plan') . ' AS ' . $p.'plan';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'anio') . ', ' . $this->_mappingFieldEntity($p.'semestre') . ', ' . $this->_mappingFieldEntity($p.'horas_catedra') . ', ' . $this->_mappingFieldEntity($p.'asignatura') . ', ' . $this->_mappingFieldEntity($p.'plan') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('asignatura', 'asi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'pla')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('asignatura', 'asi')->_join('asignatura', 'ch', $render) . '
' . EntitySql::getInstanceFromString('plan', 'pla')->_join('plan', 'ch', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}anio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}tramo": return $this->format->conditionText($f, $value, $option);
      case "{$p}asignatura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}plan": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','pla')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','pla')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('carga_horaria');
    if(!isset($data['anio']) || ($data['anio'] == '')) throw new Exception('dato obligatorio sin valor: anio');
    if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre');
    if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra');
    if(empty($data['asignatura'])) throw new Exception('dato obligatorio sin valor: asignatura');
      if(empty($data['plan'])) throw new Exception('dato obligatorio sin valor: plan');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('anio', $data)) { if(!isset($data['anio']) || ($data['anio'] == '')) throw new Exception('dato obligatorio sin valor: anio'); }
    if(array_key_exists('semestre', $data)) { if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre'); }
    if(array_key_exists('horas_catedra', $data)) { if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra'); }
    if(array_key_exists('asignatura', $data)) { if(!isset($data['asignatura']) || ($data['asignatura'] == '')) throw new Exception('dato obligatorio sin valor: asignatura'); }
    if(array_key_exists('plan', $data)) { if(!isset($data['plan']) || ($data['plan'] == '')) throw new Exception('dato obligatorio sin valor: plan'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['anio'])) $row_['anio'] = $this->format->numeric($row['anio']);
    if(isset($row['semestre'])) $row_['semestre'] = $this->format->numeric($row['semestre']);
    if(isset($row['horas_catedra'])) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(isset($row['tramo'])) $row_['tramo'] = $this->format->escapeString($row['tramo']);
    if(isset($row['asignatura']) ) $row_['asignatura'] = $this->format->positiveIntegerWithoutZerofill($row['asignatura']);
    if(isset($row['plan']) ) $row_['plan'] = $this->format->positiveIntegerWithoutZerofill($row['plan']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["anio"] = (is_null($row[$prefix . "anio"])) ? null : intval($row[$prefix . "anio"]);
    $row_["semestre"] = (is_null($row[$prefix . "semestre"])) ? null : intval($row[$prefix . "semestre"]);
    $row_["horas_catedra"] = (is_null($row[$prefix . "horas_catedra"])) ? null : intval($row[$prefix . "horas_catedra"]);
    $row_["tramo"] = (is_null($row[$prefix . "tramo"])) ? null : (string)$row[$prefix . "tramo"];
    $row_["asignatura"] = (is_null($row[$prefix . "asignatura"])) ? null : (string)$row[$prefix . "asignatura"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["plan"] = (is_null($row[$prefix . "plan"])) ? null : (string)$row[$prefix . "plan"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
