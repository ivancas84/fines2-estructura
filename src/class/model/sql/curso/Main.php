<?php
require_once("class/model/Sql.php");

class CursoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('curso');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'estado': return $t.".estado";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'horario': return $t.".horario";
      case $p.'comision': return $t.".comision";
      case $p.'carga_horaria': return $t.".carga_horaria";
      case $p.'toma_activa': return $t.".toma_activa";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'min_comision': return "MIN({$t}.comision)";
      case $p.'max_comision': return "MAX({$t}.comision)";
      case $p.'count_comision': return "COUNT({$t}.comision)";

      case $p.'min_carga_horaria': return "MIN({$t}.carga_horaria)";
      case $p.'max_carga_horaria': return "MAX({$t}.carga_horaria)";
      case $p.'count_carga_horaria': return "COUNT({$t}.carga_horaria)";

      case $p.'min_toma_activa': return "MIN({$t}.toma_activa)";
      case $p.'max_toma_activa': return "MAX({$t}.toma_activa)";
      case $p.'count_toma_activa': return "COUNT({$t}.toma_activa)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('comision', 'com')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('division', 'com_dvi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('carga_horaria', 'ch')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'ch_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('toma', 'ta')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'ta_pro')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'ta_ree')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'estado') . ' AS ' . $p.'estado, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'horario') . ' AS ' . $p.'horario, ' . $this->_mappingField($p.'comision') . ' AS ' . $p.'comision, ' . $this->_mappingField($p.'carga_horaria') . ' AS ' . $p.'carga_horaria, ' . $this->_mappingField($p.'toma_activa') . ' AS ' . $p.'toma_activa';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'estado') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'comision') . ', ' . $this->_mappingField($p.'carga_horaria') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('comision', 'com')->_fields() . ',
' . EntitySql::getInstanceRequire('division', 'com_dvi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_fields() . ',
' . EntitySql::getInstanceRequire('carga_horaria', 'ch')->_fields() . ',
' . EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'ch_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('toma', 'ta')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'ta_pro')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'ta_ree')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('comision', 'com')->_join('comision', 'curs', $render) . '
' . EntitySql::getInstanceRequire('comision', 'com_cs')->_join('comision_siguiente', 'com', $render) . '
' . EntitySql::getInstanceRequire('division', 'com_dvi')->_join('division', 'com', $render) . '
' . EntitySql::getInstanceRequire('plan', 'com_dvi_pla')->_join('plan', 'com_dvi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'com_dvi_sed')->_join('sede', 'com_dvi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'com_dvi_sed_dep')->_join('dependencia', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'com_dvi_sed_ts')->_join('tipo_sede', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'com_dvi_sed_dom')->_join('domicilio', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_coo')->_join('coordinador', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'com_dvi_sed_ref')->_join('referente', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('carga_horaria', 'ch')->_join('carga_horaria', 'curs', $render) . '
' . EntitySql::getInstanceRequire('asignatura', 'ch_asi')->_join('asignatura', 'ch', $render) . '
' . EntitySql::getInstanceRequire('plan', 'ch_pla')->_join('plan', 'ch', $render) . '
' . EntitySql::getInstanceRequire('toma', 'ta')->_join('toma_activa', 'curs', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'ta_pro')->_join('profesor', 'ta', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'ta_ree')->_join('reemplaza', 'ta', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}estado": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}horario": return $this->format->conditionText($f, $value, $option);
      case "{$p}comision": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}carga_horaria": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}toma_activa": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','com_dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','com_dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','com_dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','com_dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','com_dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','ch')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','ch_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','ch_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('toma','ta')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_pro')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_ree')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','com_dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','com_dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','com_dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','com_dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','com_dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','ch')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','ch_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','ch_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('toma','ta')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_pro')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_ree')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','com')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','com_dvi')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','com_dvi_pla')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','com_dvi_sed')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','com_dvi_sed_ts')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','com_dvi_sed_dom')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_coo')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','com_dvi_sed_ref')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','ch')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','ch_asi')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','ch_pla')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('toma','ta')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_pro')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ta_ree')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('curso');
    if(empty($data['estado'])) $data['estado'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(!isset($data['baja']))  $data['baja'] = "null";
    if(empty($data['comision'])) throw new Exception('dato obligatorio sin valor: comision');
      if(empty($data['carga_horaria'])) throw new Exception('dato obligatorio sin valor: carga_horaria');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('estado', $data)) { if(empty($data['estado'])) $data['estado'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('baja', $data)) { if(empty($data['baja']))  $data['baja'] = "null"; }
    if(array_key_exists('comision', $data)) { if(!isset($data['comision']) || ($data['comision'] == '')) throw new Exception('dato obligatorio sin valor: comision'); }
    if(array_key_exists('carga_horaria', $data)) { if(!isset($data['carga_horaria']) || ($data['carga_horaria'] == '')) throw new Exception('dato obligatorio sin valor: carga_horaria'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['estado'])) $row_['estado'] = $this->format->escapeString($row['estado']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['horario'])) $row_['horario'] = $this->format->escapeString($row['horario']);
    if(isset($row['comision']) ) $row_['comision'] = $this->format->positiveIntegerWithoutZerofill($row['comision']);
    if(isset($row['carga_horaria']) ) $row_['carga_horaria'] = $this->format->positiveIntegerWithoutZerofill($row['carga_horaria']);
    if(isset($row['toma_activa']) ) $row_['toma_activa'] = $this->format->positiveIntegerWithoutZerofill($row['toma_activa']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["estado"] = (is_null($row[$prefix . "estado"])) ? null : (string)$row[$prefix . "estado"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["horario"] = (is_null($row[$prefix . "horario"])) ? null : (string)$row[$prefix . "horario"];
    $row_["comision"] = (is_null($row[$prefix . "comision"])) ? null : (string)$row[$prefix . "comision"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["carga_horaria"] = (is_null($row[$prefix . "carga_horaria"])) ? null : (string)$row[$prefix . "carga_horaria"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["toma_activa"] = (is_null($row[$prefix . "toma_activa"])) ? null : (string)$row[$prefix . "toma_activa"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
