<?php
require_once("class/model/Sql.php");

class HorarioSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('horario');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'hora_inicio': return $t.".hora_inicio";
      case $p.'hora_fin': return $t.".hora_fin";
      case $p.'horas_catedra': return $t.".horas_catedra";
      case $p.'dia': return $t.".dia";
      case $p.'curso': return $t.".curso";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'sum_horas_catedra': return "SUM({$t}.horas_catedra)";
      case 'avg_horas_catedra': return "AVG({$t}.horas_catedra)";
      case 'min_horas_catedra': return "MIN({$t}.horas_catedra)";
      case 'max_horas_catedra': return "MAX({$t}.horas_catedra)";
      case 'count_horas_catedra': return "COUNT({$t}.horas_catedra)";

      case 'min_dia': return "MIN({$t}.dia)";
      case 'max_dia': return "MAX({$t}.dia)";
      case 'count_dia': return "COUNT({$t}.dia)";

      case 'min_curso': return "MIN({$t}.curso)";
      case 'max_curso': return "MAX({$t}.curso)";
      case 'count_curso': return "COUNT({$t}.curso)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('dia', 'dia')->_mappingFieldEntity($field)) return $f;
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
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'hora_inicio') . ' AS ' . $p.'hora_inicio, ' . $this->_mappingFieldEntity($p.'hora_fin') . ' AS ' . $p.'hora_fin, ' . $this->_mappingFieldEntity($p.'dia') . ' AS ' . $p.'dia, ' . $this->_mappingFieldEntity($p.'curso') . ' AS ' . $p.'curso';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'hora_inicio') . ', ' . $this->_mappingFieldEntity($p.'hora_fin') . ', ' . $this->_mappingFieldEntity($p.'dia') . ', ' . $this->_mappingFieldEntity($p.'curso') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('dia', 'dia')->_fields() . ',
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
' . EntitySql::getInstanceFromString('id_persona', 'cur_ta_ree')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('dia', 'dia')->_join('dia', 'hora', $render) . '
' . EntitySql::getInstanceFromString('curso', 'cur')->_join('curso', 'hora', $render) . '
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
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}hora_inicio": return $this->format->conditionTime($f, $value, $option);
      case "{$p}hora_fin": return $this->format->conditionTime($f, $value, $option);
      case "{$p}horas_catedra": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}dia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}curso": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('dia','dia')->_conditionFieldStruct($field, $option, $value)) return $c;
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
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('dia','dia')->_conditionFieldAux($field, $option, $value)) return $c;
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
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('horario');
    if(!isset($data['hora_inicio']))  throw new Exception('fecha/hora obligatoria sin valor: hora_inicio');
    if(!isset($data['hora_fin']))  throw new Exception('fecha/hora obligatoria sin valor: hora_fin');
    if(empty($data['dia'])) throw new Exception('dato obligatorio sin valor: dia');
      if(empty($data['curso'])) throw new Exception('dato obligatorio sin valor: curso');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('hora_inicio', $data)) { if(empty($data['hora_inicio']))  throw new Exception('fecha/hora obligatoria sin valor: hora_inicio'); }
    if(array_key_exists('hora_fin', $data)) { if(empty($data['hora_fin']))  throw new Exception('fecha/hora obligatoria sin valor: hora_fin'); }
    if(array_key_exists('dia', $data)) { if(!isset($data['dia']) || ($data['dia'] == '')) throw new Exception('dato obligatorio sin valor: dia'); }
    if(array_key_exists('curso', $data)) { if(!isset($data['curso']) || ($data['curso'] == '')) throw new Exception('dato obligatorio sin valor: curso'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['hora_inicio'])) $row_['hora_inicio'] = $this->format->time($row['hora_inicio']);
    if(isset($row['hora_fin'])) $row_['hora_fin'] = $this->format->time($row['hora_fin']);
    if(isset($row['horas_catedra'])) $row_['horas_catedra'] = $this->format->numeric($row['horas_catedra']);
    if(isset($row['dia']) ) $row_['dia'] = $this->format->positiveIntegerWithoutZerofill($row['dia']);
    if(isset($row['curso']) ) $row_['curso'] = $this->format->positiveIntegerWithoutZerofill($row['curso']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["hora_inicio"] = (is_null($row[$prefix . "hora_inicio"])) ? null : (string)$row[$prefix . "hora_inicio"];
    $row_["hora_fin"] = (is_null($row[$prefix . "hora_fin"])) ? null : (string)$row[$prefix . "hora_fin"];
    $row_["dia"] = (is_null($row[$prefix . "dia"])) ? null : (string)$row[$prefix . "dia"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["curso"] = (is_null($row[$prefix . "curso"])) ? null : (string)$row[$prefix . "curso"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
