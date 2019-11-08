<?php
require_once("class/model/Sql.php");

class ComisionSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('comision');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'anio': return $t.".anio";
      case $p.'semestre': return $t.".semestre";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'fecha': return $t.".fecha";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'comentario': return $t.".comentario";
      case $p.'autorizada': return $t.".autorizada";
      case $p.'apertura': return $t.".apertura";
      case $p.'publicar': return $t.".publicar";
      case $p.'fecha_anio': return $t.".fecha_anio";
      case $p.'fecha_semestre': return $t.".fecha_semestre";
      case $p.'tramo': return $t.".tramo";
      case $p.'horario': return $t.".horario";
      case $p.'periodo': return $t.".periodo";
      case $p.'comision_siguiente': return $t.".comision_siguiente";
      case $p.'division': return $t.".division";
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

      case $p.'sum_anio': return "SUM({$t}.anio)";
      case $p.'avg_anio': return "AVG({$t}.anio)";
      case $p.'min_anio': return "MIN({$t}.anio)";
      case $p.'max_anio': return "MAX({$t}.anio)";
      case $p.'count_anio': return "COUNT({$t}.anio)";

      case $p.'sum_semestre': return "SUM({$t}.semestre)";
      case $p.'avg_semestre': return "AVG({$t}.semestre)";
      case $p.'min_semestre': return "MIN({$t}.semestre)";
      case $p.'max_semestre': return "MAX({$t}.semestre)";
      case $p.'count_semestre': return "COUNT({$t}.semestre)";

      case $p.'avg_fecha': return "AVG({$t}.fecha)";
      case $p.'min_fecha': return "MIN({$t}.fecha)";
      case $p.'max_fecha': return "MAX({$t}.fecha)";
      case $p.'count_fecha': return "COUNT({$t}.fecha)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'sum_fecha_semestre': return "SUM({$t}.fecha_semestre)";
      case $p.'avg_fecha_semestre': return "AVG({$t}.fecha_semestre)";
      case $p.'min_fecha_semestre': return "MIN({$t}.fecha_semestre)";
      case $p.'max_fecha_semestre': return "MAX({$t}.fecha_semestre)";
      case $p.'count_fecha_semestre': return "COUNT({$t}.fecha_semestre)";

      case $p.'min_comision_siguiente': return "MIN({$t}.comision_siguiente)";
      case $p.'max_comision_siguiente': return "MAX({$t}.comision_siguiente)";
      case $p.'count_comision_siguiente': return "COUNT({$t}.comision_siguiente)";

      case $p.'min_division': return "MIN({$t}.division)";
      case $p.'max_division': return "MAX({$t}.division)";
      case $p.'count_division': return "COUNT({$t}.division)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('division', 'dvi')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'dvi_pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'dvi_sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'dvi_sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dvi_sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'dvi_sed_coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'dvi_sed_ref')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'anio') . ' AS ' . $p.'anio, ' . $this->_mappingField($p.'semestre') . ' AS ' . $p.'semestre, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'fecha') . ' AS ' . $p.'fecha, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'comentario') . ' AS ' . $p.'comentario, ' . $this->_mappingField($p.'autorizada') . ' AS ' . $p.'autorizada, ' . $this->_mappingField($p.'apertura') . ' AS ' . $p.'apertura, ' . $this->_mappingField($p.'publicar') . ' AS ' . $p.'publicar, ' . $this->_mappingField($p.'fecha_anio') . ' AS ' . $p.'fecha_anio, ' . $this->_mappingField($p.'fecha_semestre') . ' AS ' . $p.'fecha_semestre, ' . $this->_mappingField($p.'tramo') . ' AS ' . $p.'tramo, ' . $this->_mappingField($p.'horario') . ' AS ' . $p.'horario, ' . $this->_mappingField($p.'periodo') . ' AS ' . $p.'periodo, ' . $this->_mappingField($p.'comision_siguiente') . ' AS ' . $p.'comision_siguiente, ' . $this->_mappingField($p.'division') . ' AS ' . $p.'division';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'anio') . ', ' . $this->_mappingField($p.'semestre') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'fecha') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'comentario') . ', ' . $this->_mappingField($p.'autorizada') . ', ' . $this->_mappingField($p.'apertura') . ', ' . $this->_mappingField($p.'publicar') . ', ' . $this->_mappingField($p.'fecha_anio') . ', ' . $this->_mappingField($p.'fecha_semestre') . ', ' . $this->_mappingField($p.'comision_siguiente') . ', ' . $this->_mappingField($p.'division') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('division', 'dvi')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'dvi_pla')->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'dvi_sed')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'dvi_sed_ref')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('division', 'dvi')->_join('division', 'comi', $render) . '
' . EntitySql::getInstanceRequire('plan', 'dvi_pla')->_join('plan', 'dvi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'dvi_sed')->_join('sede', 'dvi', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'dvi_sed_ts')->_join('tipo_sede', 'dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'dvi_sed_dom')->_join('domicilio', 'dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'dvi_sed_coo')->_join('coordinador', 'dvi_sed', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'dvi_sed_ref')->_join('referente', 'dvi_sed', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}anio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha": return $this->format->conditionDate($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}comentario": return $this->format->conditionText($f, $value, $option);
      case "{$p}autorizada": return $this->format->conditionBoolean($f, $value);
      case "{$p}apertura": return $this->format->conditionBoolean($f, $value);
      case "{$p}publicar": return $this->format->conditionBoolean($f, $value);
      case "{$p}fecha_anio": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_semestre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}tramo": return $this->format->conditionText($f, $value, $option);
      case "{$p}horario": return $this->format->conditionText($f, $value, $option);
      case "{$p}periodo": return $this->format->conditionText($f, $value, $option);
      case "{$p}comision_siguiente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}division": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('division','dvi')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','dvi_pla')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','dvi_sed')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','dvi_sed_ts')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dvi_sed_dom')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_coo')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','dvi_sed_ref')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('comision');
    if(!isset($data['anio']) || ($data['anio'] == '')) throw new Exception('dato obligatorio sin valor: anio');
    if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre');
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['comentario'])) $data['comentario'] = "null";
    if(!isset($data['autorizada']) || ($data['autorizada'] == '')) $data['autorizada'] = "false";
    if(!isset($data['apertura']) || ($data['apertura'] == '')) $data['apertura'] = "false";
    if(!isset($data['publicar']) || ($data['publicar'] == '')) $data['publicar'] = "false";
    if(!isset($data['fecha_anio']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_anio');
    if(!isset($data['fecha_semestre']) || ($data['fecha_semestre'] == '')) throw new Exception('dato obligatorio sin valor: fecha_semestre');
    if(empty($data['comision_siguiente'])) $data['comision_siguiente'] = "null";
      if(empty($data['division'])) throw new Exception('dato obligatorio sin valor: division');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('anio', $data)) { if(!isset($data['anio']) || ($data['anio'] == '')) throw new Exception('dato obligatorio sin valor: anio'); }
    if(array_key_exists('semestre', $data)) { if(!isset($data['semestre']) || ($data['semestre'] == '')) throw new Exception('dato obligatorio sin valor: semestre'); }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('comentario', $data)) { if(empty($data['comentario'])) $data['comentario'] = "null"; }
    if(array_key_exists('autorizada', $data)) { if(!isset($data['autorizada']) || ($data['autorizada'] == '')) $data['autorizada'] = "false"; }
    if(array_key_exists('apertura', $data)) { if(!isset($data['apertura']) || ($data['apertura'] == '')) $data['apertura'] = "false"; }
    if(array_key_exists('publicar', $data)) { if(!isset($data['publicar']) || ($data['publicar'] == '')) $data['publicar'] = "false"; }
    if(array_key_exists('fecha_anio', $data)) { if(empty($data['fecha_anio']))  throw new Exception('fecha/hora obligatoria sin valor: fecha_anio'); }
    if(array_key_exists('fecha_semestre', $data)) { if(!isset($data['fecha_semestre']) || ($data['fecha_semestre'] == '')) throw new Exception('dato obligatorio sin valor: fecha_semestre'); }
    if(array_key_exists('comision_siguiente', $data)) { if(!isset($data['comision_siguiente']) || ($data['comision_siguiente'] == '')) $data['comision_siguiente'] = "null"; }
    if(array_key_exists('division', $data)) { if(!isset($data['division']) || ($data['division'] == '')) throw new Exception('dato obligatorio sin valor: division'); }

    return $data;
  }

  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['anio'])) $row_['anio'] = $this->format->numeric($row['anio']);
    if(isset($row['semestre'])) $row_['semestre'] = $this->format->numeric($row['semestre']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['fecha'])) $row_['fecha'] = $this->format->date($row['fecha']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['comentario'])) $row_['comentario'] = $this->format->escapeString($row['comentario']);
    if(isset($row['autorizada'])) $row_['autorizada'] = $this->format->boolean($row['autorizada']);
    if(isset($row['apertura'])) $row_['apertura'] = $this->format->boolean($row['apertura']);
    if(isset($row['publicar'])) $row_['publicar'] = $this->format->boolean($row['publicar']);
    if(isset($row['fecha_anio'])) $row_['fecha_anio'] = $this->format->year($row['fecha_anio']);
    if(isset($row['fecha_semestre'])) $row_['fecha_semestre'] = $this->format->numeric($row['fecha_semestre']);
    if(isset($row['tramo'])) $row_['tramo'] = $this->format->escapeString($row['tramo']);
    if(isset($row['horario'])) $row_['horario'] = $this->format->escapeString($row['horario']);
    if(isset($row['periodo'])) $row_['periodo'] = $this->format->escapeString($row['periodo']);
    if(isset($row['comision_siguiente']) ) $row_['comision_siguiente'] = $this->format->positiveIntegerWithoutZerofill($row['comision_siguiente']);
    if(isset($row['division']) ) $row_['division'] = $this->format->positiveIntegerWithoutZerofill($row['division']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["anio"] = (is_null($row[$prefix . "anio"])) ? null : intval($row[$prefix . "anio"]);
    $row_["semestre"] = (is_null($row[$prefix . "semestre"])) ? null : intval($row[$prefix . "semestre"]);
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["fecha"] = (is_null($row[$prefix . "fecha"])) ? null : (string)$row[$prefix . "fecha"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["comentario"] = (is_null($row[$prefix . "comentario"])) ? null : (string)$row[$prefix . "comentario"];
    $row_["autorizada"] = (is_null($row[$prefix . "autorizada"])) ? null : settypebool($row[$prefix . "autorizada"]);
    $row_["apertura"] = (is_null($row[$prefix . "apertura"])) ? null : settypebool($row[$prefix . "apertura"]);
    $row_["publicar"] = (is_null($row[$prefix . "publicar"])) ? null : settypebool($row[$prefix . "publicar"]);
    $row_["fecha_anio"] = (is_null($row[$prefix . "fecha_anio"])) ? null : (string)$row[$prefix . "fecha_anio"];
    $row_["fecha_semestre"] = (is_null($row[$prefix . "fecha_semestre"])) ? null : intval($row[$prefix . "fecha_semestre"]);
    $row_["tramo"] = (is_null($row[$prefix . "tramo"])) ? null : (string)$row[$prefix . "tramo"];
    $row_["horario"] = (is_null($row[$prefix . "horario"])) ? null : (string)$row[$prefix . "horario"];
    $row_["periodo"] = (is_null($row[$prefix . "periodo"])) ? null : (string)$row[$prefix . "periodo"];
    $row_["comision_siguiente"] = (is_null($row[$prefix . "comision_siguiente"])) ? null : (string)$row[$prefix . "comision_siguiente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["division"] = (is_null($row[$prefix . "division"])) ? null : (string)$row[$prefix . "division"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
