<?php
require_once("class/model/Sql.php");

class NotaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('nota');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nota': return $t.".nota";
      case $p.'alta': return $t.".alta";
      case $p.'profesor': return $t.".profesor";
      case $p.'curso': return $t.".curso";
      case $p.'alumno': return $t.".alumno";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'sum_nota': return "SUM({$t}.nota)";
      case 'avg_nota': return "AVG({$t}.nota)";
      case 'min_nota': return "MIN({$t}.nota)";
      case 'max_nota': return "MAX({$t}.nota)";
      case 'count_nota': return "COUNT({$t}.nota)";

      case 'avg_alta': return "AVG({$t}.alta)";
      case 'min_alta': return "MIN({$t}.alta)";
      case 'max_alta': return "MAX({$t}.alta)";
      case 'count_alta': return "COUNT({$t}.alta)";

      case 'min_profesor': return "MIN({$t}.profesor)";
      case 'max_profesor': return "MAX({$t}.profesor)";
      case 'count_profesor': return "COUNT({$t}.profesor)";

      case 'min_curso': return "MIN({$t}.curso)";
      case 'max_curso': return "MAX({$t}.curso)";
      case 'count_curso': return "COUNT({$t}.curso)";

      case 'min_alumno': return "MIN({$t}.alumno)";
      case 'max_alumno': return "MAX({$t}.alumno)";
      case 'count_alumno': return "COUNT({$t}.alumno)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'pro')->_mappingFieldEntity($field)) return $f;
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
    if($f = EntitySql::getInstanceFromString('toma', 'cur_ta')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'cur_ta_pro')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'alu')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'nota') . ' AS ' . $p.'nota, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'profesor') . ' AS ' . $p.'profesor, ' . $this->_mappingFieldEntity($p.'curso') . ' AS ' . $p.'curso, ' . $this->_mappingFieldEntity($p.'alumno') . ' AS ' . $p.'alumno';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'nota') . ', ' . $this->_mappingFieldEntity($p.'alta') . ', ' . $this->_mappingFieldEntity($p.'profesor') . ', ' . $this->_mappingFieldEntity($p.'curso') . ', ' . $this->_mappingFieldEntity($p.'alumno') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'pro')->_fields() . ',
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
' . EntitySql::getInstanceFromString('toma', 'cur_ta')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'cur_ta_pro')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'alu')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('id_persona', 'pro')->_join('profesor', 'nota', $render) . '
' . EntitySql::getInstanceFromString('curso', 'cur')->_join('curso', 'nota', $render) . '
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
' . EntitySql::getInstanceFromString('toma', 'cur_ta')->_join('toma_activa', 'cur', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'cur_ta_pro')->_join('profesor', 'cur_ta', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_join('reemplaza', 'cur_ta', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'alu')->_join('alumno', 'nota', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}nota": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}profesor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}curso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alumno": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','pro')->_conditionFieldStruct($field, $option, $value)) return $c;
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
    if($c = EntitySql::getInstanceFromString('toma','cur_ta')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_ta_pro')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_ta_ree')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','alu')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','pro')->_conditionFieldAux($field, $option, $value)) return $c;
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
    if($c = EntitySql::getInstanceFromString('toma','cur_ta')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_ta_pro')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','cur_ta_ree')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','alu')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('nota');
    if(!isset($data['nota']) || ($data['nota'] == '')) throw new Exception('dato obligatorio sin valor: nota');
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['profesor'])) throw new Exception('dato obligatorio sin valor: profesor');
      if(empty($data['curso'])) throw new Exception('dato obligatorio sin valor: curso');
      if(empty($data['alumno'])) throw new Exception('dato obligatorio sin valor: alumno');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('nota', $data)) { if(!isset($data['nota']) || ($data['nota'] == '')) throw new Exception('dato obligatorio sin valor: nota'); }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('profesor', $data)) { if(!isset($data['profesor']) || ($data['profesor'] == '')) throw new Exception('dato obligatorio sin valor: profesor'); }
    if(array_key_exists('curso', $data)) { if(!isset($data['curso']) || ($data['curso'] == '')) throw new Exception('dato obligatorio sin valor: curso'); }
    if(array_key_exists('alumno', $data)) { if(!isset($data['alumno']) || ($data['alumno'] == '')) throw new Exception('dato obligatorio sin valor: alumno'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['nota'])) $row_['nota'] = $this->format->numeric($row['nota']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['profesor']) ) $row_['profesor'] = $this->format->positiveIntegerWithoutZerofill($row['profesor']);
    if(isset($row['curso']) ) $row_['curso'] = $this->format->positiveIntegerWithoutZerofill($row['curso']);
    if(isset($row['alumno']) ) $row_['alumno'] = $this->format->positiveIntegerWithoutZerofill($row['alumno']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nota"] = (is_null($row[$prefix . "nota"])) ? null : intval($row[$prefix . "nota"]);
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["profesor"] = (is_null($row[$prefix . "profesor"])) ? null : (string)$row[$prefix . "profesor"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["curso"] = (is_null($row[$prefix . "curso"])) ? null : (string)$row[$prefix . "curso"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["alumno"] = (is_null($row[$prefix . "alumno"])) ? null : (string)$row[$prefix . "alumno"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
