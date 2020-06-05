<?php
require_once("class/model/Sql.php");

class _PlanSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('plan');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'orientacion': return $t.".orientacion";
      case $p.'resolucion': return $t.".resolucion";
      case $p.'distribucion_horaria': return $t.".distribucion_horaria";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_orientacion': return "MIN({$t}.orientacion)";
      case $p.'max_orientacion': return "MAX({$t}.orientacion)";
      case $p.'count_orientacion': return "COUNT({$t}.orientacion)";

      case $p.'min_resolucion': return "MIN({$t}.resolucion)";
      case $p.'max_resolucion': return "MAX({$t}.resolucion)";
      case $p.'count_resolucion': return "COUNT({$t}.resolucion)";

      case $p.'min_distribucion_horaria': return "MIN({$t}.distribucion_horaria)";
      case $p.'max_distribucion_horaria': return "MAX({$t}.distribucion_horaria)";
      case $p.'count_distribucion_horaria': return "COUNT({$t}.distribucion_horaria)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'orientacion') . ' AS ' . $p.'orientacion, ' . $this->_mappingField($p.'resolucion') . ' AS ' . $p.'resolucion, ' . $this->_mappingField($p.'distribucion_horaria') . ' AS ' . $p.'distribucion_horaria';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'orientacion') . ', ' . $this->_mappingField($p.'resolucion') . ', ' . $this->_mappingField($p.'distribucion_horaria') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}orientacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}resolucion": return $this->format->conditionText($f, $value, $option);
      case "{$p}distribucion_horaria": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_orientacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_orientacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_orientacion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_resolucion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_resolucion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_resolucion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_distribucion_horaria": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_distribucion_horaria": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_distribucion_horaria": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('plan');
    if(!isset($data['orientacion']) || is_null($data['orientacion']) || $data['orientacion'] == "") throw new Exception('dato obligatorio sin valor: orientacion');
    if(!isset($data['resolucion']) || is_null($data['resolucion']) || $data['resolucion'] == "") $data['resolucion'] = "null";
    if(!isset($data['distribucion_horaria']) || is_null($data['distribucion_horaria']) || $data['distribucion_horaria'] == "") $data['distribucion_horaria'] = "null";

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('orientacion', $data)) { if(is_null($data['orientacion']) || $data['orientacion'] == "") throw new Exception('dato obligatorio sin valor: orientacion'); }
    if(array_key_exists('resolucion', $data)) { if(is_null($data['resolucion']) || $data['resolucion'] == "") $data['resolucion'] = "null"; }
    if(array_key_exists('distribucion_horaria', $data)) { if(is_null($data['distribucion_horaria']) || $data['distribucion_horaria'] == "") $data['distribucion_horaria'] = "null"; }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['orientacion'])) $row_['orientacion'] = $this->format->escapeString($row['orientacion']);
    if(isset($row['resolucion'])) $row_['resolucion'] = $this->format->escapeString($row['resolucion']);
    if(isset($row['distribucion_horaria'])) $row_['distribucion_horaria'] = $this->format->escapeString($row['distribucion_horaria']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["orientacion"] = (is_null($row[$prefix . "orientacion"])) ? null : (string)$row[$prefix . "orientacion"];
    $row_["resolucion"] = (is_null($row[$prefix . "resolucion"])) ? null : (string)$row[$prefix . "resolucion"];
    $row_["distribucion_horaria"] = (is_null($row[$prefix . "distribucion_horaria"])) ? null : (string)$row[$prefix . "distribucion_horaria"];
    return $row_;
  }



}
