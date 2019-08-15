<?php
require_once("class/model/Sql.php");

class TomaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('toma');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_toma': return $t.".fecha_toma";
      case $p.'fecha_inicio': return $t.".fecha_inicio";
      case $p.'fecha_fin': return $t.".fecha_fin";
      case $p.'fecha_entrada_contralor': return $t.".fecha_entrada_contralor";
      case $p.'estado': return $t.".estado";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'comentario_contralor': return $t.".comentario_contralor";
      case $p.'alta': return $t.".alta";
      case $p.'tipo_movimiento': return $t.".tipo_movimiento";
      case $p.'estado_contralor': return $t.".estado_contralor";
      case $p.'fecha_desde': return $t.".fecha_desde";
      case $p.'suma_horas_catedra': return $t.".suma_horas_catedra";
      case $p.'curso': return $t.".curso";
      case $p.'profesor': return $t.".profesor";
      case $p.'reemplaza': return $t.".reemplaza";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'avg_fecha_toma': return "AVG({$t}.fecha_toma)";
      case 'min_fecha_toma': return "MIN({$t}.fecha_toma)";
      case 'max_fecha_toma': return "MAX({$t}.fecha_toma)";
      case 'count_fecha_toma': return "COUNT({$t}.fecha_toma)";

      case 'avg_fecha_inicio': return "AVG({$t}.fecha_inicio)";
      case 'min_fecha_inicio': return "MIN({$t}.fecha_inicio)";
      case 'max_fecha_inicio': return "MAX({$t}.fecha_inicio)";
      case 'count_fecha_inicio': return "COUNT({$t}.fecha_inicio)";

      case 'avg_fecha_fin': return "AVG({$t}.fecha_fin)";
      case 'min_fecha_fin': return "MIN({$t}.fecha_fin)";
      case 'max_fecha_fin': return "MAX({$t}.fecha_fin)";
      case 'count_fecha_fin': return "COUNT({$t}.fecha_fin)";

      case 'avg_fecha_entrada_contralor': return "AVG({$t}.fecha_entrada_contralor)";
      case 'min_fecha_entrada_contralor': return "MIN({$t}.fecha_entrada_contralor)";
      case 'max_fecha_entrada_contralor': return "MAX({$t}.fecha_entrada_contralor)";
      case 'count_fecha_entrada_contralor': return "COUNT({$t}.fecha_entrada_contralor)";

      case 'avg_alta': return "AVG({$t}.alta)";
      case 'min_alta': return "MIN({$t}.alta)";
      case 'max_alta': return "MAX({$t}.alta)";
      case 'count_alta': return "COUNT({$t}.alta)";

      case 'avg_fecha_desde': return "AVG({$t}.fecha_desde)";
      case 'min_fecha_desde': return "MIN({$t}.fecha_desde)";
      case 'max_fecha_desde': return "MAX({$t}.fecha_desde)";
      case 'count_fecha_desde': return "COUNT({$t}.fecha_desde)";

      case 'sum_suma_horas_catedra': return "SUM({$t}.suma_horas_catedra)";
      case 'avg_suma_horas_catedra': return "AVG({$t}.suma_horas_catedra)";
      case 'min_suma_horas_catedra': return "MIN({$t}.suma_horas_catedra)";
      case 'max_suma_horas_catedra': return "MAX({$t}.suma_horas_catedra)";
      case 'count_suma_horas_catedra': return "COUNT({$t}.suma_horas_catedra)";

      case 'min_curso': return "MIN({$t}.curso)";
      case 'max_curso': return "MAX({$t}.curso)";
      case 'count_curso': return "COUNT({$t}.curso)";

      case 'min_profesor': return "MIN({$t}.profesor)";
      case 'max_profesor': return "MAX({$t}.profesor)";
      case 'count_profesor': return "COUNT({$t}.profesor)";

      case 'min_reemplaza': return "MIN({$t}.reemplaza)";
      case 'max_reemplaza': return "MAX({$t}.reemplaza)";
      case 'count_reemplaza': return "COUNT({$t}.reemplaza)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('curso', 'cur')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('comision', 'cur_com')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('division', 'cur_com_dvi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'cur_com_dvi_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'cur_com_dvi_sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'cur_com_dvi_sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_ref')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('carga_horaria', 'cur_ch')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('asignatura', 'cur_ch_asi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'cur_ch_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'pro')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'ree')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'fecha_toma') . ' AS ' . $p.'fecha_toma, ' . $this->_mappingFieldEntity($p.'fecha_inicio') . ' AS ' . $p.'fecha_inicio, ' . $this->_mappingFieldEntity($p.'fecha_fin') . ' AS ' . $p.'fecha_fin, ' . $this->_mappingFieldEntity($p.'fecha_entrada_contralor') . ' AS ' . $p.'fecha_entrada_contralor, ' . $this->_mappingFieldEntity($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingFieldEntity($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingFieldEntity($p.'comentario_contralor') . ' AS ' . $p.'comentario_contralor, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'tipo_movimiento') . ' AS ' . $p.'tipo_movimiento, ' . $this->_mappingFieldEntity($p.'estado_contralor') . ' AS ' . $p.'estado_contralor, ' . $this->_mappingFieldEntity($p.'fecha_desde') . ' AS ' . $p.'fecha_desde, ' . $this->_mappingFieldEntity($p.'curso') . ' AS ' . $p.'curso, ' . $this->_mappingFieldEntity($p.'profesor') . ' AS ' . $p.'profesor, ' . $this->_mappingFieldEntity($p.'reemplaza') . ' AS ' . $p.'reemplaza';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'fecha_toma') . ', ' . $this->_mappingFieldEntity($p.'fecha_inicio') . ', ' . $this->_mappingFieldEntity($p.'fecha_fin') . ', ' . $this->_mappingFieldEntity($p.'fecha_entrada_contralor') . ', ' . $this->_mappingFieldEntity($p.'estado') . ', ' . $this->_mappingFieldEntity($p.'observaciones') . ', ' . $this->_mappingFieldEntity($p.'comentario_contralor') . ', ' . $this->_mappingFieldEntity($p.'alta') . ', ' . $this->_mappingFieldEntity($p.'tipo_movimiento') . ', ' . $this->_mappingFieldEntity($p.'estado_contralor') . ', ' . $this->_mappingFieldEntity($p.'curso') . ', ' . $this->_mappingFieldEntity($p.'profesor') . ', ' . $this->_mappingFieldEntity($p.'reemplaza') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('curso', 'cur')->_fields() . ',
' . EntitySql::getInstanceFromString('comision', 'cur_com')->_fields() . ',
' . EntitySql::getInstanceFromString('division', 'cur_com_dvi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'cur_com_dvi_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'cur_com_dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'cur_com_dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_ref')->_fields() . ',
' . EntitySql::getInstanceFromString('carga_horaria', 'cur_ch')->_fields() . ',
' . EntitySql::getInstanceFromString('asignatura', 'cur_ch_asi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'cur_ch_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'pro')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'ree')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('curso', 'cur')->_join('curso', 'toma', $render) . '
' . EntitySql::getInstanceFromString('comision', 'cur_com')->_join('comision', 'cur', $render) . '
' . EntitySql::getInstanceFromString('comision', 'cur_com_cs')->_join('comision_siguiente', 'cur_com', $render) . '
' . EntitySql::getInstanceFromString('division', 'cur_com_dvi')->_join('division', 'cur_com', $render) . '
' . EntitySql::getInstanceFromString('plan', 'cur_com_dvi_pla')->_join('plan', 'cur_com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed')->_join('sede', 'cur_com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'cur_com_dvi_sed_dep')->_join('dependencia', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'cur_com_dvi_sed_ts')->_join('tipo_sede', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'cur_com_dvi_sed_dom')->_join('domicilio', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_coo')->_join('coordinador', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'cur_com_dvi_sed_ref')->_join('referente', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('carga_horaria', 'cur_ch')->_join('carga_horaria', 'cur', $render) . '
' . EntitySql::getInstanceFromString('asignatura', 'cur_ch_asi')->_join('asignatura', 'cur_ch', $render) . '
' . EntitySql::getInstanceFromString('plan', 'cur_ch_pla')->_join('plan', 'cur_ch', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'pro')->_join('profesor', 'toma', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'ree')->_join('reemplaza', 'toma', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}fecha_toma": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fecha_inicio": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fecha_fin": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fecha_entrada_contralor": return $this->format->conditionDate($f, $value, $option);
      case "{$p}estado": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}comentario_contralor": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}tipo_movimiento": return $this->format->conditionText($f, $value, $option);
      case "{$p}estado_contralor": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_desde": return $this->format->conditionDate($f, $value, $option);
      case "{$p}suma_horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}curso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}profesor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}reemplaza": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('curso','cur')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','cur_com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','cur_com_dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','cur_com_dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','cur_com_dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','cur_com_dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','cur_com_dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_com_dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_com_dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('carga_horaria','cur_ch')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','cur_ch_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','cur_ch_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','pro')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','ree')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('curso','cur')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','cur_com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','cur_com_dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','cur_com_dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','cur_com_dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','cur_com_dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','cur_com_dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_com_dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_com_dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('carga_horaria','cur_ch')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','cur_ch_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','cur_ch_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','pro')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','ree')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('toma');
    if(!isset($data['fecha_toma']))  $data['fecha_toma'] = "null";
    if(!isset($data['fecha_inicio']))  $data['fecha_inicio'] = "null";
    if(!isset($data['fecha_fin']))  $data['fecha_fin'] = "null";
    if(!isset($data['fecha_entrada_contralor']))  $data['fecha_entrada_contralor'] = "null";
    if(empty($data['estado'])) $data['estado'] = "Pendiente";
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['comentario_contralor'])) $data['comentario_contralor'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['tipo_movimiento'])) $data['tipo_movimiento'] = "AI";
    if(empty($data['estado_contralor'])) $data['estado_contralor'] = "Pasar";
    if(empty($data['curso'])) throw new Exception('dato obligatorio sin valor: curso');
      if(empty($data['profesor'])) $data['profesor'] = "null";
      if(empty($data['reemplaza'])) $data['reemplaza'] = "null";
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('fecha_toma', $data)) { if(empty($data['fecha_toma']))  $data['fecha_toma'] = "null"; }
    if(array_key_exists('fecha_inicio', $data)) { if(empty($data['fecha_inicio']))  $data['fecha_inicio'] = "null"; }
    if(array_key_exists('fecha_fin', $data)) { if(empty($data['fecha_fin']))  $data['fecha_fin'] = "null"; }
    if(array_key_exists('fecha_entrada_contralor', $data)) { if(empty($data['fecha_entrada_contralor']))  $data['fecha_entrada_contralor'] = "null"; }
    if(array_key_exists('estado', $data)) { if(empty($data['estado'])) $data['estado'] = "Pendiente"; }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('comentario_contralor', $data)) { if(empty($data['comentario_contralor'])) $data['comentario_contralor'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('tipo_movimiento', $data)) { if(empty($data['tipo_movimiento'])) $data['tipo_movimiento'] = "AI"; }
    if(array_key_exists('estado_contralor', $data)) { if(empty($data['estado_contralor'])) $data['estado_contralor'] = "Pasar"; }
    if(array_key_exists('curso', $data)) { if(!isset($data['curso']) || ($data['curso'] == '')) throw new Exception('dato obligatorio sin valor: curso'); }
    if(array_key_exists('profesor', $data)) { if(!isset($data['profesor']) || ($data['profesor'] == '')) $data['profesor'] = "null"; }
    if(array_key_exists('reemplaza', $data)) { if(!isset($data['reemplaza']) || ($data['reemplaza'] == '')) $data['reemplaza'] = "null"; }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['fecha_toma'])) $row_['fecha_toma'] = $this->format->date($row['fecha_toma']);
    if(isset($row['fecha_inicio'])) $row_['fecha_inicio'] = $this->format->date($row['fecha_inicio']);
    if(isset($row['fecha_fin'])) $row_['fecha_fin'] = $this->format->date($row['fecha_fin']);
    if(isset($row['fecha_entrada_contralor'])) $row_['fecha_entrada_contralor'] = $this->format->date($row['fecha_entrada_contralor']);
    if(isset($row['estado'])) $row_['estado'] = $this->format->escapeString($row['estado']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['comentario_contralor'])) $row_['comentario_contralor'] = $this->format->escapeString($row['comentario_contralor']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['tipo_movimiento'])) $row_['tipo_movimiento'] = $this->format->escapeString($row['tipo_movimiento']);
    if(isset($row['estado_contralor'])) $row_['estado_contralor'] = $this->format->escapeString($row['estado_contralor']);
    if(isset($row['fecha_desde'])) $row_['fecha_desde'] = $this->format->date($row['fecha_desde']);
    if(isset($row['suma_horas_catedra'])) $row_['suma_horas_catedra'] = $this->format->numeric($row['suma_horas_catedra']);
    if(isset($row['curso']) ) $row_['curso'] = $this->format->positiveIntegerWithoutZerofill($row['curso']);
    if(isset($row['profesor']) ) $row_['profesor'] = $this->format->positiveIntegerWithoutZerofill($row['profesor']);
    if(isset($row['reemplaza']) ) $row_['reemplaza'] = $this->format->positiveIntegerWithoutZerofill($row['reemplaza']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fecha_toma"] = (is_null($row[$prefix . "fecha_toma"])) ? null : (string)$row[$prefix . "fecha_toma"];
    $row_["fecha_inicio"] = (is_null($row[$prefix . "fecha_inicio"])) ? null : (string)$row[$prefix . "fecha_inicio"];
    $row_["fecha_fin"] = (is_null($row[$prefix . "fecha_fin"])) ? null : (string)$row[$prefix . "fecha_fin"];
    $row_["fecha_entrada_contralor"] = (is_null($row[$prefix . "fecha_entrada_contralor"])) ? null : (string)$row[$prefix . "fecha_entrada_contralor"];
    $row_["estado"] = (is_null($row[$prefix . "estado"])) ? null : (string)$row[$prefix . "estado"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["comentario_contralor"] = (is_null($row[$prefix . "comentario_contralor"])) ? null : (string)$row[$prefix . "comentario_contralor"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["tipo_movimiento"] = (is_null($row[$prefix . "tipo_movimiento"])) ? null : (string)$row[$prefix . "tipo_movimiento"];
    $row_["estado_contralor"] = (is_null($row[$prefix . "estado_contralor"])) ? null : (string)$row[$prefix . "estado_contralor"];
    $row_["fecha_desde"] = (is_null($row[$prefix . "fecha_desde"])) ? null : (string)$row[$prefix . "fecha_desde"];
    $row_["curso"] = (is_null($row[$prefix . "curso"])) ? null : (string)$row[$prefix . "curso"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["profesor"] = (is_null($row[$prefix . "profesor"])) ? null : (string)$row[$prefix . "profesor"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["reemplaza"] = (is_null($row[$prefix . "reemplaza"])) ? null : (string)$row[$prefix . "reemplaza"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
