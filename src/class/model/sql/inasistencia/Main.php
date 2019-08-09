<?php
require_once("class/model/Sql.php");

class InasistenciaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('inasistencia');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_desde': return $t.".fecha_desde";
      case $p.'fecha_hasta': return $t.".fecha_hasta";
      case $p.'modulos_semanales': return $t.".modulos_semanales";
      case $p.'modulos_mensuales': return $t.".modulos_mensuales";
      case $p.'articulo': return $t.".articulo";
      case $p.'inciso': return $t.".inciso";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'toma': return $t.".toma";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'avg_fecha_desde': return "AVG({$t}.fecha_desde)";
      case 'min_fecha_desde': return "MIN({$t}.fecha_desde)";
      case 'max_fecha_desde': return "MAX({$t}.fecha_desde)";
      case 'count_fecha_desde': return "COUNT({$t}.fecha_desde)";

      case 'avg_fecha_hasta': return "AVG({$t}.fecha_hasta)";
      case 'min_fecha_hasta': return "MIN({$t}.fecha_hasta)";
      case 'max_fecha_hasta': return "MAX({$t}.fecha_hasta)";
      case 'count_fecha_hasta': return "COUNT({$t}.fecha_hasta)";

      case 'sum_modulos_semanales': return "SUM({$t}.modulos_semanales)";
      case 'avg_modulos_semanales': return "AVG({$t}.modulos_semanales)";
      case 'min_modulos_semanales': return "MIN({$t}.modulos_semanales)";
      case 'max_modulos_semanales': return "MAX({$t}.modulos_semanales)";
      case 'count_modulos_semanales': return "COUNT({$t}.modulos_semanales)";

      case 'sum_modulos_mensuales': return "SUM({$t}.modulos_mensuales)";
      case 'avg_modulos_mensuales': return "AVG({$t}.modulos_mensuales)";
      case 'min_modulos_mensuales': return "MIN({$t}.modulos_mensuales)";
      case 'max_modulos_mensuales': return "MAX({$t}.modulos_mensuales)";
      case 'count_modulos_mensuales': return "COUNT({$t}.modulos_mensuales)";

      case 'min_toma': return "MIN({$t}.toma)";
      case 'max_toma': return "MAX({$t}.toma)";
      case 'count_toma': return "COUNT({$t}.toma)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('toma', 'tom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('curso', 'tom_cur')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('comision', 'tom_cur_com')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('division', 'tom_cur_com_dvi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'tom_cur_com_dvi_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'tom_cur_com_dvi_sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'tom_cur_com_dvi_sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'tom_cur_com_dvi_sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_ref')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('carga_horaria', 'tom_cur_ch')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('asignatura', 'tom_cur_ch_asi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'tom_cur_ch_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'tom_pro')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'tom_ree')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'fecha_desde') . ' AS ' . $p.'fecha_desde, ' . $this->_mappingFieldEntity($p.'fecha_hasta') . ' AS ' . $p.'fecha_hasta, ' . $this->_mappingFieldEntity($p.'modulos_semanales') . ' AS ' . $p.'modulos_semanales, ' . $this->_mappingFieldEntity($p.'modulos_mensuales') . ' AS ' . $p.'modulos_mensuales, ' . $this->_mappingFieldEntity($p.'articulo') . ' AS ' . $p.'articulo, ' . $this->_mappingFieldEntity($p.'inciso') . ' AS ' . $p.'inciso, ' . $this->_mappingFieldEntity($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingFieldEntity($p.'toma') . ' AS ' . $p.'toma';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'fecha_desde') . ', ' . $this->_mappingFieldEntity($p.'fecha_hasta') . ', ' . $this->_mappingFieldEntity($p.'modulos_semanales') . ', ' . $this->_mappingFieldEntity($p.'modulos_mensuales') . ', ' . $this->_mappingFieldEntity($p.'articulo') . ', ' . $this->_mappingFieldEntity($p.'inciso') . ', ' . $this->_mappingFieldEntity($p.'observaciones') . ', ' . $this->_mappingFieldEntity($p.'toma') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('toma', 'tom')->_fields() . ',
' . EntitySql::getInstanceFromString('curso', 'tom_cur')->_fields() . ',
' . EntitySql::getInstanceFromString('comision', 'tom_cur_com')->_fields() . ',
' . EntitySql::getInstanceFromString('division', 'tom_cur_com_dvi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'tom_cur_com_dvi_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'tom_cur_com_dvi_sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'tom_cur_com_dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'tom_cur_com_dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_ref')->_fields() . ',
' . EntitySql::getInstanceFromString('carga_horaria', 'tom_cur_ch')->_fields() . ',
' . EntitySql::getInstanceFromString('asignatura', 'tom_cur_ch_asi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'tom_cur_ch_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'tom_pro')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'tom_ree')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('toma', 'tom')->_join('toma', 'inas', $render) . '
' . EntitySql::getInstanceFromString('curso', 'tom_cur')->_join('curso', 'tom', $render) . '
' . EntitySql::getInstanceFromString('comision', 'tom_cur_com')->_join('comision', 'tom_cur', $render) . '
' . EntitySql::getInstanceFromString('comision', 'tom_cur_com_cs')->_join('comision_siguiente', 'tom_cur_com', $render) . '
' . EntitySql::getInstanceFromString('division', 'tom_cur_com_dvi')->_join('division', 'tom_cur_com', $render) . '
' . EntitySql::getInstanceFromString('plan', 'tom_cur_com_dvi_pla')->_join('plan', 'tom_cur_com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'tom_cur_com_dvi_sed')->_join('sede', 'tom_cur_com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'tom_cur_com_dvi_sed_dep')->_join('dependencia', 'tom_cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'tom_cur_com_dvi_sed_ts')->_join('tipo_sede', 'tom_cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'tom_cur_com_dvi_sed_dom')->_join('domicilio', 'tom_cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_coo')->_join('coordinador', 'tom_cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'tom_cur_com_dvi_sed_ref')->_join('referente', 'tom_cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('carga_horaria', 'tom_cur_ch')->_join('carga_horaria', 'tom_cur', $render) . '
' . EntitySql::getInstanceFromString('asignatura', 'tom_cur_ch_asi')->_join('asignatura', 'tom_cur_ch', $render) . '
' . EntitySql::getInstanceFromString('plan', 'tom_cur_ch_pla')->_join('plan', 'tom_cur_ch', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'tom_pro')->_join('profesor', 'tom', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'tom_ree')->_join('reemplaza', 'tom', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}fecha_desde": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fecha_hasta": return $this->format->conditionDate($f, $value, $option);
      case "{$p}modulos_semanales": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}modulos_mensuales": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}articulo": return $this->format->conditionText($f, $value, $option);
      case "{$p}inciso": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}toma": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('toma','tom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('curso','tom_cur')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','tom_cur_com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','tom_cur_com_dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','tom_cur_com_dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','tom_cur_com_dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','tom_cur_com_dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','tom_cur_com_dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_cur_com_dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_cur_com_dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('carga_horaria','tom_cur_ch')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','tom_cur_ch_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','tom_cur_ch_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_pro')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_ree')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('toma','tom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('curso','tom_cur')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','tom_cur_com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','tom_cur_com_dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','tom_cur_com_dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','tom_cur_com_dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','tom_cur_com_dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','tom_cur_com_dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_cur_com_dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_cur_com_dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('carga_horaria','tom_cur_ch')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('asignatura','tom_cur_ch_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','tom_cur_ch_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_pro')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','tom_ree')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('inasistencia');
    if(!isset($data['fecha_desde']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_desde');
    if(!isset($data['fecha_hasta']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_hasta');
    if(!isset($data['modulos_semanales']) || ($data['modulos_semanales'] == '')) $data['modulos_semanales'] = "null";
    if(!isset($data['modulos_mensuales']) || ($data['modulos_mensuales'] == '')) $data['modulos_mensuales'] = "null";
    if(empty($data['articulo'])) $data['articulo'] = "null";
    if(empty($data['inciso'])) $data['inciso'] = "null";
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['toma'])) throw new Exception('dato obligatorio sin valor: toma');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('fecha_desde', $data)) { if(empty($data['fecha_desde']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_desde'); }
    if(array_key_exists('fecha_hasta', $data)) { if(empty($data['fecha_hasta']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_hasta'); }
    if(array_key_exists('modulos_semanales', $data)) { if(!isset($data['modulos_semanales']) || ($data['modulos_semanales'] == '')) $data['modulos_semanales'] = "null"; }
    if(array_key_exists('modulos_mensuales', $data)) { if(!isset($data['modulos_mensuales']) || ($data['modulos_mensuales'] == '')) $data['modulos_mensuales'] = "null"; }
    if(array_key_exists('articulo', $data)) { if(empty($data['articulo'])) $data['articulo'] = "null"; }
    if(array_key_exists('inciso', $data)) { if(empty($data['inciso'])) $data['inciso'] = "null"; }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('toma', $data)) { if(!isset($data['toma']) || ($data['toma'] == '')) throw new Exception('dato obligatorio sin valor: toma'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['fecha_desde'])) $row_['fecha_desde'] = $this->format->date($row['fecha_desde']);
    if(isset($row['fecha_hasta'])) $row_['fecha_hasta'] = $this->format->date($row['fecha_hasta']);
    if(isset($row['modulos_semanales'])) $row_['modulos_semanales'] = $this->format->numeric($row['modulos_semanales']);
    if(isset($row['modulos_mensuales'])) $row_['modulos_mensuales'] = $this->format->numeric($row['modulos_mensuales']);
    if(isset($row['articulo'])) $row_['articulo'] = $this->format->escapeString($row['articulo']);
    if(isset($row['inciso'])) $row_['inciso'] = $this->format->escapeString($row['inciso']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['toma']) ) $row_['toma'] = $this->format->positiveIntegerWithoutZerofill($row['toma']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fecha_desde"] = (is_null($row[$prefix . "fecha_desde"])) ? null : (string)$row[$prefix . "fecha_desde"];
    $row_["fecha_hasta"] = (is_null($row[$prefix . "fecha_hasta"])) ? null : (string)$row[$prefix . "fecha_hasta"];
    $row_["modulos_semanales"] = (is_null($row[$prefix . "modulos_semanales"])) ? null : intval($row[$prefix . "modulos_semanales"]);
    $row_["modulos_mensuales"] = (is_null($row[$prefix . "modulos_mensuales"])) ? null : intval($row[$prefix . "modulos_mensuales"]);
    $row_["articulo"] = (is_null($row[$prefix . "articulo"])) ? null : (string)$row[$prefix . "articulo"];
    $row_["inciso"] = (is_null($row[$prefix . "inciso"])) ? null : (string)$row[$prefix . "inciso"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["toma"] = (is_null($row[$prefix . "toma"])) ? null : (string)$row[$prefix . "toma"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
