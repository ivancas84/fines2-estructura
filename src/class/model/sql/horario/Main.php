<?php
require_once("class/model/Sql.php");

class HorarioSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('horario');
  }


  public function _mappingFieldStruct($field){
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
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('dia', 'dia')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('curso', 'cur')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('comision', 'cur_com')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('division', 'cur_com_dvi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'cur_com_dvi_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'cur_com_dvi_sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'cur_com_dvi_sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'cur_com_dvi_sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_ref')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('carga_horaria', 'cur_ch')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('asignatura', 'cur_ch_asi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'cur_ch_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('toma', 'cur_ta')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'cur_ta_pro')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'cur_ta_ree')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'hora_inicio') . ' AS ' . $p.'hora_inicio, ' . $this->_mappingField($p.'hora_fin') . ' AS ' . $p.'hora_fin, ' . $this->_mappingField($p.'dia') . ' AS ' . $p.'dia, ' . $this->_mappingField($p.'curso') . ' AS ' . $p.'curso';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'hora_inicio') . ', ' . $this->_mappingField($p.'hora_fin') . ', ' . $this->_mappingField($p.'dia') . ', ' . $this->_mappingField($p.'curso') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('dia', 'dia')->_fields() . ',
' . EntitySql::getInstanceRequire('curso', 'cur')->_fields() . ',
' . EntitySql::getInstanceRequire('comision', 'cur_com')->_fields() . ',
' . EntitySql::getInstanceRequire('division', 'cur_com_dvi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'cur_com_dvi_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'cur_com_dvi_sed')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'cur_com_dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_ref')->_fields() . ',
' . EntitySql::getInstanceRequire('carga_horaria', 'cur_ch')->_fields() . ',
' . EntitySql::getInstanceRequire('asignatura', 'cur_ch_asi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'cur_ch_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('toma', 'cur_ta')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'cur_ta_pro')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'cur_ta_ree')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('dia', 'dia')->_join('dia', 'hora', $render) . '
' . EntitySql::getInstanceRequire('curso', 'cur')->_join('curso', 'hora', $render) . '
' . EntitySql::getInstanceRequire('comision', 'cur_com')->_join('comision', 'cur', $render) . '
' . EntitySql::getInstanceRequire('comision', 'cur_com_cs')->_join('comision_siguiente', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('division', 'cur_com_dvi')->_join('division', 'cur_com', $render) . '
' . EntitySql::getInstanceRequire('plan', 'cur_com_dvi_pla')->_join('plan', 'cur_com_dvi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'cur_com_dvi_sed')->_join('sede', 'cur_com_dvi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'cur_com_dvi_sed_dep')->_join('dependencia', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'cur_com_dvi_sed_ts')->_join('tipo_sede', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'cur_com_dvi_sed_dom')->_join('domicilio', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_coo')->_join('coordinador', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'cur_com_dvi_sed_ref')->_join('referente', 'cur_com_dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('carga_horaria', 'cur_ch')->_join('carga_horaria', 'cur', $render) . '
' . EntitySql::getInstanceRequire('asignatura', 'cur_ch_asi')->_join('asignatura', 'cur_ch', $render) . '
' . EntitySql::getInstanceRequire('plan', 'cur_ch_pla')->_join('plan', 'cur_ch', $render) . '
' . EntitySql::getInstanceRequire('toma', 'cur_ta')->_join('toma_activa', 'cur', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'cur_ta_pro')->_join('profesor', 'cur_ta', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'cur_ta_ree')->_join('reemplaza', 'cur_ta', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
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
    if($c = EntitySql::getInstanceRequire('dia','dia')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('curso','cur')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','cur_com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','cur_com_dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_com_dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','cur_com_dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','cur_com_dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_com_dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_com_dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','cur_ch')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','cur_ch_asi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_ch_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('toma','cur_ta')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_ta_pro')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_ta_ree')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('dia','dia')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('curso','cur')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('comision','cur_com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','cur_com_dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_com_dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','cur_com_dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','cur_com_dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','cur_com_dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_com_dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_com_dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('carga_horaria','cur_ch')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('asignatura','cur_ch_asi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','cur_ch_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('toma','cur_ta')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_ta_pro')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','cur_ta_ree')->_conditionFieldAux($field, $option, $value)) return $c;
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
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
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
