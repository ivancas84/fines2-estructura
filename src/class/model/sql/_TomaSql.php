<?php
require_once("class/model/Sql.php");

class _TomaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('toma');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_toma': return $t.".fecha_toma";
      case $p.'estado': return $t.".estado";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'comentario': return $t.".comentario";
      case $p.'tipo_movimiento': return $t.".tipo_movimiento";
      case $p.'estado_contralor': return $t.".estado_contralor";
      case $p.'alta': return $t.".alta";
      case $p.'curso': return $t.".curso";
      case $p.'docente': return $t.".docente";
      case $p.'reemplazo': return $t.".reemplazo";
      case $p.'planilla_docente': return $t.".planilla_docente";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_fecha_toma': return "AVG({$t}.fecha_toma)";
      case $p.'min_fecha_toma': return "MIN({$t}.fecha_toma)";
      case $p.'max_fecha_toma': return "MAX({$t}.fecha_toma)";
      case $p.'count_fecha_toma': return "COUNT({$t}.fecha_toma)";

      case $p.'min_estado': return "MIN({$t}.estado)";
      case $p.'max_estado': return "MAX({$t}.estado)";
      case $p.'count_estado': return "COUNT({$t}.estado)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'min_comentario': return "MIN({$t}.comentario)";
      case $p.'max_comentario': return "MAX({$t}.comentario)";
      case $p.'count_comentario': return "COUNT({$t}.comentario)";

      case $p.'min_tipo_movimiento': return "MIN({$t}.tipo_movimiento)";
      case $p.'max_tipo_movimiento': return "MAX({$t}.tipo_movimiento)";
      case $p.'count_tipo_movimiento': return "COUNT({$t}.tipo_movimiento)";

      case $p.'min_estado_contralor': return "MIN({$t}.estado_contralor)";
      case $p.'max_estado_contralor': return "MAX({$t}.estado_contralor)";
      case $p.'count_estado_contralor': return "COUNT({$t}.estado_contralor)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_curso': return "MIN({$t}.curso)";
      case $p.'max_curso': return "MAX({$t}.curso)";
      case $p.'count_curso': return "COUNT({$t}.curso)";

      case $p.'min_docente': return "MIN({$t}.docente)";
      case $p.'max_docente': return "MAX({$t}.docente)";
      case $p.'count_docente': return "COUNT({$t}.docente)";

      case $p.'min_reemplazo': return "MIN({$t}.reemplazo)";
      case $p.'max_reemplazo': return "MAX({$t}.reemplazo)";
      case $p.'count_reemplazo': return "COUNT({$t}.reemplazo)";

      case $p.'min_planilla_docente': return "MIN({$t}.planilla_docente)";
      case $p.'max_planilla_docente': return "MAX({$t}.planilla_docente)";
      case $p.'count_planilla_docente': return "COUNT({$t}.planilla_docente)";

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
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'fecha_toma') . ' AS ' . $p.'fecha_toma, ' . $this->_mappingField($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'comentario') . ' AS ' . $p.'comentario, ' . $this->_mappingField($p.'tipo_movimiento') . ' AS ' . $p.'tipo_movimiento, ' . $this->_mappingField($p.'estado_contralor') . ' AS ' . $p.'estado_contralor, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'curso') . ' AS ' . $p.'curso, ' . $this->_mappingField($p.'docente') . ' AS ' . $p.'docente, ' . $this->_mappingField($p.'reemplazo') . ' AS ' . $p.'reemplazo, ' . $this->_mappingField($p.'planilla_docente') . ' AS ' . $p.'planilla_docente';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'fecha_toma') . ', ' . $this->_mappingField($p.'estado') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'comentario') . ', ' . $this->_mappingField($p.'tipo_movimiento') . ', ' . $this->_mappingField($p.'estado_contralor') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'curso') . ', ' . $this->_mappingField($p.'docente') . ', ' . $this->_mappingField($p.'reemplazo') . ', ' . $this->_mappingField($p.'planilla_docente') . '';
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
      case "{$p}fecha_toma": return $this->format->conditionDate($f, $value, $option);
      case "{$p}estado": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}comentario": return $this->format->conditionText($f, $value, $option);
      case "{$p}tipo_movimiento": return $this->format->conditionText($f, $value, $option);
      case "{$p}estado_contralor": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}curso": return $this->format->conditionText($f, $value, $option);
      case "{$p}docente": return $this->format->conditionText($f, $value, $option);
      case "{$p}reemplazo": return $this->format->conditionText($f, $value, $option);
      case "{$p}planilla_docente": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_fecha_toma": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_fecha_toma": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_fecha_toma": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_fecha_toma": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_estado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_estado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_estado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_observaciones": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_comentario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_comentario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_comentario": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_tipo_movimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_tipo_movimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_tipo_movimiento": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_estado_contralor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_estado_contralor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_estado_contralor": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_alta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_curso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_curso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_curso": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_docente": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_reemplazo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_reemplazo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_reemplazo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_planilla_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_planilla_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_planilla_docente": return $this->format->conditionNumber($f, $value, $option);

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
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('toma');
    if(!isset($data['fecha_toma']))  $data['fecha_toma'] = "null";
    if(!isset($data['estado']) || is_null($data['estado']) || $data['estado'] == "") $data['estado'] = "null";
    if(!isset($data['observaciones']) || is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null";
    if(!isset($data['comentario']) || is_null($data['comentario']) || $data['comentario'] == "") $data['comentario'] = "null";
    if(!isset($data['tipo_movimiento']) || is_null($data['tipo_movimiento']) || $data['tipo_movimiento'] == "") throw new Exception('dato obligatorio sin valor: tipo_movimiento');
    if(!isset($data['estado_contralor']) || is_null($data['estado_contralor']) || $data['estado_contralor'] == "") $data['estado_contralor'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['curso'])) throw new Exception('dato obligatorio sin valor: curso');
    if(empty($data['docente'])) $data['docente'] = "null";
    if(empty($data['reemplazo'])) $data['reemplazo'] = "null";
    if(empty($data['planilla_docente'])) $data['planilla_docente'] = "null";

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('fecha_toma', $data)) { if(empty($data['fecha_toma']))  $data['fecha_toma'] = "null"; }
    if(array_key_exists('estado', $data)) { if(is_null($data['estado']) || $data['estado'] == "") $data['estado'] = "null"; }
    if(array_key_exists('observaciones', $data)) { if(is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null"; }
    if(array_key_exists('comentario', $data)) { if(is_null($data['comentario']) || $data['comentario'] == "") $data['comentario'] = "null"; }
    if(array_key_exists('tipo_movimiento', $data)) { if(is_null($data['tipo_movimiento']) || $data['tipo_movimiento'] == "") throw new Exception('dato obligatorio sin valor: tipo_movimiento'); }
    if(array_key_exists('estado_contralor', $data)) { if(is_null($data['estado_contralor']) || $data['estado_contralor'] == "") $data['estado_contralor'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('curso', $data)) { if(!isset($data['curso']) || ($data['curso'] == '')) throw new Exception('dato obligatorio sin valor: curso'); }
    if(array_key_exists('docente', $data)) { if(!isset($data['docente']) || ($data['docente'] == '')) $data['docente'] = "null"; }
    if(array_key_exists('reemplazo', $data)) { if(!isset($data['reemplazo']) || ($data['reemplazo'] == '')) $data['reemplazo'] = "null"; }
    if(array_key_exists('planilla_docente', $data)) { if(!isset($data['planilla_docente']) || ($data['planilla_docente'] == '')) $data['planilla_docente'] = "null"; }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['fecha_toma'])) $row_['fecha_toma'] = $this->format->date($row['fecha_toma']);
    if(isset($row['estado'])) $row_['estado'] = $this->format->escapeString($row['estado']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['comentario'])) $row_['comentario'] = $this->format->escapeString($row['comentario']);
    if(isset($row['tipo_movimiento'])) $row_['tipo_movimiento'] = $this->format->escapeString($row['tipo_movimiento']);
    if(isset($row['estado_contralor'])) $row_['estado_contralor'] = $this->format->escapeString($row['estado_contralor']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['curso'])) $row_['curso'] = $this->format->escapeString($row['curso']);
    if(isset($row['docente'])) $row_['docente'] = $this->format->escapeString($row['docente']);
    if(isset($row['reemplazo'])) $row_['reemplazo'] = $this->format->escapeString($row['reemplazo']);
    if(isset($row['planilla_docente'])) $row_['planilla_docente'] = $this->format->escapeString($row['planilla_docente']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fecha_toma"] = (is_null($row[$prefix . "fecha_toma"])) ? null : (string)$row[$prefix . "fecha_toma"];
    $row_["estado"] = (is_null($row[$prefix . "estado"])) ? null : (string)$row[$prefix . "estado"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["comentario"] = (is_null($row[$prefix . "comentario"])) ? null : (string)$row[$prefix . "comentario"];
    $row_["tipo_movimiento"] = (is_null($row[$prefix . "tipo_movimiento"])) ? null : (string)$row[$prefix . "tipo_movimiento"];
    $row_["estado_contralor"] = (is_null($row[$prefix . "estado_contralor"])) ? null : (string)$row[$prefix . "estado_contralor"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["curso"] = (is_null($row[$prefix . "curso"])) ? null : (string)$row[$prefix . "curso"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["docente"] = (is_null($row[$prefix . "docente"])) ? null : (string)$row[$prefix . "docente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["reemplazo"] = (is_null($row[$prefix . "reemplazo"])) ? null : (string)$row[$prefix . "reemplazo"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["planilla_docente"] = (is_null($row[$prefix . "planilla_docente"])) ? null : (string)$row[$prefix . "planilla_docente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}