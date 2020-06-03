<?php
require_once("class/model/Sql.php");

class _CalendarioSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('calendario');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'inicio': return $t.".inicio";
      case $p.'fin': return $t.".fin";
      case $p.'anio': return $t.".anio";
      case $p.'semestre': return $t.".semestre";
      case $p.'insertado': return $t.".insertado";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_inicio': return "AVG({$t}.inicio)";
      case $p.'min_inicio': return "MIN({$t}.inicio)";
      case $p.'max_inicio': return "MAX({$t}.inicio)";
      case $p.'count_inicio': return "COUNT({$t}.inicio)";

      case $p.'avg_fin': return "AVG({$t}.fin)";
      case $p.'min_fin': return "MIN({$t}.fin)";
      case $p.'max_fin': return "MAX({$t}.fin)";
      case $p.'count_fin': return "COUNT({$t}.fin)";

      case $p.'min_anio': return "MIN({$t}.anio)";
      case $p.'max_anio': return "MAX({$t}.anio)";
      case $p.'count_anio': return "COUNT({$t}.anio)";

      case $p.'sum_semestre': return "SUM({$t}.semestre)";
      case $p.'avg_semestre': return "AVG({$t}.semestre)";
      case $p.'min_semestre': return "MIN({$t}.semestre)";
      case $p.'max_semestre': return "MAX({$t}.semestre)";
      case $p.'count_semestre': return "COUNT({$t}.semestre)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'inicio') . ' AS ' . $p.'inicio, ' . $this->_mappingField($p.'fin') . ' AS ' . $p.'fin, ' . $this->_mappingField($p.'anio') . ' AS ' . $p.'anio, ' . $this->_mappingField($p.'semestre') . ' AS ' . $p.'semestre, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'inicio') . ', ' . $this->_mappingField($p.'fin') . ', ' . $this->_mappingField($p.'anio') . ', ' . $this->_mappingField($p.'semestre') . ', ' . $this->_mappingField($p.'insertado') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}inicio": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fin": return $this->format->conditionDate($f, $value, $option);
      case "{$p}anio": return $this->format->conditionText($f, $value, $option);
      case "{$p}semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}insertado": return $this->format->conditionTimestamp($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_inicio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_inicio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_inicio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_inicio": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_fin": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_fin": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_fin": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_fin": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_anio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_anio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_anio": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}sum_semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}avg_semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_semestre": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_insertado": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('calendario');
    if(!isset($data['inicio']))  $data['inicio'] = "null";
    if(!isset($data['fin']))  $data['fin'] = "null";
    if(!isset($data['anio']))  throw new Exception('fecha/hora obligatoria sin valor: anio');
    if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre');
    if(!isset($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s");

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('inicio', $data)) { if(empty($data['inicio']))  $data['inicio'] = "null"; }
    if(array_key_exists('fin', $data)) { if(empty($data['fin']))  $data['fin'] = "null"; }
    if(array_key_exists('anio', $data)) { if(empty($data['anio']))  throw new Exception('fecha/hora obligatoria sin valor: anio'); }
    if(array_key_exists('semestre', $data)) { if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre'); }
    if(array_key_exists('insertado', $data)) { if(empty($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s"); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['inicio'])) $row_['inicio'] = $this->format->date($row['inicio']);
    if(isset($row['fin'])) $row_['fin'] = $this->format->date($row['fin']);
    if(isset($row['anio'])) $row_['anio'] = $this->format->year($row['anio']);
    if(isset($row['semestre'])) $row_['semestre'] = $this->format->numeric($row['semestre']);
    if(isset($row['insertado'])) $row_['insertado'] = $this->format->timestamp($row['insertado']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["inicio"] = (is_null($row[$prefix . "inicio"])) ? null : (string)$row[$prefix . "inicio"];
    $row_["fin"] = (is_null($row[$prefix . "fin"])) ? null : (string)$row[$prefix . "fin"];
    $row_["anio"] = (is_null($row[$prefix . "anio"])) ? null : (string)$row[$prefix . "anio"];
    $row_["semestre"] = (is_null($row[$prefix . "semestre"])) ? null : intval($row[$prefix . "semestre"]);
    $row_["insertado"] = (is_null($row[$prefix . "insertado"])) ? null : (string)$row[$prefix . "insertado"];
    return $row_;
  }



}
