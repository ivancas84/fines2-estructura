<?php
require_once("class/model/Sql.php");

class _DistribucionHorariaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('distribucion_horaria');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'dia': return $t.".dia";
      case $p.'asignatura': return $t.".asignatura";
      case $p.'planificacion': return $t.".planificacion";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case $p.'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case $p.'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case $p.'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case $p.'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case $p.'sum_dia': return "SUM({$t}.dia)";
      case $p.'avg_dia': return "AVG({$t}.dia)";
      case $p.'min_dia': return "MIN({$t}.dia)";
      case $p.'max_dia': return "MAX({$t}.dia)";
      case $p.'count_dia': return "COUNT({$t}.dia)";

      case $p.'min_asignatura': return "MIN({$t}.asignatura)";
      case $p.'max_asignatura': return "MAX({$t}.asignatura)";
      case $p.'count_asignatura': return "COUNT({$t}.asignatura)";

      case $p.'min_planificacion': return "MIN({$t}.planificacion)";
      case $p.'max_planificacion': return "MAX({$t}.planificacion)";
      case $p.'count_planificacion': return "COUNT({$t}.planificacion)";

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
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'horas_catedra') . ' AS ' . $p.'horas_catedra, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia, ' . $this->_mappingField($p.'asignatura') . ' AS ' . $p.'asignatura, ' . $this->_mappingField($p.'planificacion') . ' AS ' . $p.'planificacion';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'horas_catedra') . ', ' . $this->_mappingField($p.'dia') . ', ' . $this->_mappingField($p.'asignatura') . ', ' . $this->_mappingField($p.'planificacion') . '';
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
      case "{$p}dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}asignatura": return $this->format->conditionText($f, $value, $option);
      case "{$p}planificacion": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_horas_catedra": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_dia": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_asignatura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_asignatura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_asignatura": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_planificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_planificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_planificacion": return $this->format->conditionNumber($f, $value, $option);

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
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('distribucion_horaria');
    if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra');
    if(!isset($data['dia']) || ($data['dia'] == '')) throw new Exception('dato obligatorio sin valor: dia');
    if(empty($data['asignatura'])) throw new Exception('dato obligatorio sin valor: asignatura');
    if(empty($data['planificacion'])) throw new Exception('dato obligatorio sin valor: planificacion');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('horas_catedra', $data)) { if(!isset($data['horas_catedra']) || ($data['horas_catedra'] == '')) throw new Exception('dato obligatorio sin valor: horas_catedra'); }
    if(array_key_exists('dia', $data)) { if(!isset($data['dia']) || ($data['dia'] == '')) throw new Exception('dato obligatorio sin valor: dia'); }
    if(array_key_exists('asignatura', $data)) { if(!isset($data['asignatura']) || ($data['asignatura'] == '')) throw new Exception('dato obligatorio sin valor: asignatura'); }
    if(array_key_exists('planificacion', $data)) { if(!isset($data['planificacion']) || ($data['planificacion'] == '')) throw new Exception('dato obligatorio sin valor: planificacion'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['horas_catedra'])) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(isset($row['dia'])) $row_['dia'] = $this->format->numeric($row['dia']);
    if(isset($row['asignatura'])) $row_['asignatura'] = $this->format->escapeString($row['asignatura']);
    if(isset($row['planificacion'])) $row_['planificacion'] = $this->format->escapeString($row['planificacion']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["horas_catedra"] = (is_null($row[$prefix . "horas_catedra"])) ? null : intval($row[$prefix . "horas_catedra"]);
    $row_["dia"] = (is_null($row[$prefix . "dia"])) ? null : intval($row[$prefix . "dia"]);
    $row_["asignatura"] = (is_null($row[$prefix . "asignatura"])) ? null : (string)$row[$prefix . "asignatura"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["planificacion"] = (is_null($row[$prefix . "planificacion"])) ? null : (string)$row[$prefix . "planificacion"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}