<?php
require_once("class/model/Sql.php");

class Nomina2SqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('nomina2');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fotocopia_documento': return $t.".fotocopia_documento";
      case $p.'partida_nacimiento': return $t.".partida_nacimiento";
      case $p.'alta': return $t.".alta";
      case $p.'constancia_cuil': return $t.".constancia_cuil";
      case $p.'certificado_estudios': return $t.".certificado_estudios";
      case $p.'anio_ingreso': return $t.".anio_ingreso";
      case $p.'activo': return $t.".activo";
      case $p.'programa': return $t.".programa";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'persona': return $t.".persona";
      case $p.'comision': return $t.".comision";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'avg_alta': return "AVG({$t}.alta)";
      case 'min_alta': return "MIN({$t}.alta)";
      case 'max_alta': return "MAX({$t}.alta)";
      case 'count_alta': return "COUNT({$t}.alta)";

      case 'sum_anio_ingreso': return "SUM({$t}.anio_ingreso)";
      case 'avg_anio_ingreso': return "AVG({$t}.anio_ingreso)";
      case 'min_anio_ingreso': return "MIN({$t}.anio_ingreso)";
      case 'max_anio_ingreso': return "MAX({$t}.anio_ingreso)";
      case 'count_anio_ingreso': return "COUNT({$t}.anio_ingreso)";

      case 'min_persona': return "MIN({$t}.persona)";
      case 'max_persona': return "MAX({$t}.persona)";
      case 'count_persona': return "COUNT({$t}.persona)";

      case 'min_comision': return "MIN({$t}.comision)";
      case 'max_comision': return "MAX({$t}.comision)";
      case 'count_comision': return "COUNT({$t}.comision)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'per')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('comision', 'com')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('division', 'com_dvi')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'com_dvi_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'com_dvi_sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'com_dvi_sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'com_dvi_sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_ref')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'fotocopia_documento') . ' AS ' . $p.'fotocopia_documento, ' . $this->_mappingFieldEntity($p.'partida_nacimiento') . ' AS ' . $p.'partida_nacimiento, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'constancia_cuil') . ' AS ' . $p.'constancia_cuil, ' . $this->_mappingFieldEntity($p.'certificado_estudios') . ' AS ' . $p.'certificado_estudios, ' . $this->_mappingFieldEntity($p.'anio_ingreso') . ' AS ' . $p.'anio_ingreso, ' . $this->_mappingFieldEntity($p.'activo') . ' AS ' . $p.'activo, ' . $this->_mappingFieldEntity($p.'programa') . ' AS ' . $p.'programa, ' . $this->_mappingFieldEntity($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingFieldEntity($p.'persona') . ' AS ' . $p.'persona, ' . $this->_mappingFieldEntity($p.'comision') . ' AS ' . $p.'comision';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'fotocopia_documento') . ', ' . $this->_mappingFieldEntity($p.'partida_nacimiento') . ', ' . $this->_mappingFieldEntity($p.'alta') . ', ' . $this->_mappingFieldEntity($p.'constancia_cuil') . ', ' . $this->_mappingFieldEntity($p.'certificado_estudios') . ', ' . $this->_mappingFieldEntity($p.'anio_ingreso') . ', ' . $this->_mappingFieldEntity($p.'activo') . ', ' . $this->_mappingFieldEntity($p.'programa') . ', ' . $this->_mappingFieldEntity($p.'observaciones') . ', ' . $this->_mappingFieldEntity($p.'persona') . ', ' . $this->_mappingFieldEntity($p.'comision') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'per')->_fields() . ',
' . EntitySql::getInstanceFromString('comision', 'com')->_fields() . ',
' . EntitySql::getInstanceFromString('division', 'com_dvi')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'com_dvi_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'com_dvi_sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'com_dvi_sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'com_dvi_sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_ref')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('id_persona', 'per')->_join('persona', 'noa', $render) . '
' . EntitySql::getInstanceFromString('comision', 'com')->_join('comision', 'noa', $render) . '
' . EntitySql::getInstanceFromString('comision', 'com_cs')->_join('comision_siguiente', 'com', $render) . '
' . EntitySql::getInstanceFromString('division', 'com_dvi')->_join('division', 'com', $render) . '
' . EntitySql::getInstanceFromString('plan', 'com_dvi_pla')->_join('plan', 'com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'com_dvi_sed')->_join('sede', 'com_dvi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'com_dvi_sed_dep')->_join('dependencia', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'com_dvi_sed_ts')->_join('tipo_sede', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'com_dvi_sed_dom')->_join('domicilio', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_coo')->_join('coordinador', 'com_dvi_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'com_dvi_sed_ref')->_join('referente', 'com_dvi_sed', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}fotocopia_documento": return $this->format->conditionBoolean($f, $value);
      case "{$p}partida_nacimiento": return $this->format->conditionBoolean($f, $value);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}constancia_cuil": return $this->format->conditionBoolean($f, $value);
      case "{$p}certificado_estudios": return $this->format->conditionBoolean($f, $value);
      case "{$p}anio_ingreso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}activo": return $this->format->conditionBoolean($f, $value);
      case "{$p}programa": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}comision": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','com')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','com_dvi')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','com_dvi_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','com_dvi_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','com_dvi_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','com_dvi_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','com_dvi_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','com_dvi_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('comision','com')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','com_dvi')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','com_dvi_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','com_dvi_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','com_dvi_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','com_dvi_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','com_dvi_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','com_dvi_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('nomina2');
    if(!isset($data['fotocopia_documento']) || ($data['fotocopia_documento'] == '')) $data['fotocopia_documento'] = "false";
    if(!isset($data['partida_nacimiento']) || ($data['partida_nacimiento'] == '')) $data['partida_nacimiento'] = "false";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(!isset($data['constancia_cuil']) || ($data['constancia_cuil'] == '')) $data['constancia_cuil'] = "false";
    if(!isset($data['certificado_estudios']) || ($data['certificado_estudios'] == '')) $data['certificado_estudios'] = "false";
    if(!isset($data['anio_ingreso']) || ($data['anio_ingreso'] == '')) $data['anio_ingreso'] = "null";
    if(!isset($data['activo']) || ($data['activo'] == '')) $data['activo'] = "false";
    if(empty($data['programa'])) $data['programa'] = "null";
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');
      if(empty($data['comision'])) throw new Exception('dato obligatorio sin valor: comision');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('fotocopia_documento', $data)) { if(!isset($data['fotocopia_documento']) || ($data['fotocopia_documento'] == '')) $data['fotocopia_documento'] = "false"; }
    if(array_key_exists('partida_nacimiento', $data)) { if(!isset($data['partida_nacimiento']) || ($data['partida_nacimiento'] == '')) $data['partida_nacimiento'] = "false"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('constancia_cuil', $data)) { if(!isset($data['constancia_cuil']) || ($data['constancia_cuil'] == '')) $data['constancia_cuil'] = "false"; }
    if(array_key_exists('certificado_estudios', $data)) { if(!isset($data['certificado_estudios']) || ($data['certificado_estudios'] == '')) $data['certificado_estudios'] = "false"; }
    if(array_key_exists('anio_ingreso', $data)) { if(!isset($data['anio_ingreso']) || ($data['anio_ingreso'] == '')) $data['anio_ingreso'] = "null"; }
    if(array_key_exists('activo', $data)) { if(!isset($data['activo']) || ($data['activo'] == '')) $data['activo'] = "false"; }
    if(array_key_exists('programa', $data)) { if(empty($data['programa'])) $data['programa'] = "null"; }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }
    if(array_key_exists('comision', $data)) { if(!isset($data['comision']) || ($data['comision'] == '')) throw new Exception('dato obligatorio sin valor: comision'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['fotocopia_documento'])) $row_['fotocopia_documento'] = $this->format->boolean($row['fotocopia_documento']);
    if(isset($row['partida_nacimiento'])) $row_['partida_nacimiento'] = $this->format->boolean($row['partida_nacimiento']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['constancia_cuil'])) $row_['constancia_cuil'] = $this->format->boolean($row['constancia_cuil']);
    if(isset($row['certificado_estudios'])) $row_['certificado_estudios'] = $this->format->boolean($row['certificado_estudios']);
    if(isset($row['anio_ingreso'])) $row_['anio_ingreso'] = $this->format->numeric($row['anio_ingreso']);
    if(isset($row['activo'])) $row_['activo'] = $this->format->boolean($row['activo']);
    if(isset($row['programa'])) $row_['programa'] = $this->format->escapeString($row['programa']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['persona']) ) $row_['persona'] = $this->format->positiveIntegerWithoutZerofill($row['persona']);
    if(isset($row['comision']) ) $row_['comision'] = $this->format->positiveIntegerWithoutZerofill($row['comision']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fotocopia_documento"] = (is_null($row[$prefix . "fotocopia_documento"])) ? null : settypebool($row[$prefix . "fotocopia_documento"]);
    $row_["partida_nacimiento"] = (is_null($row[$prefix . "partida_nacimiento"])) ? null : settypebool($row[$prefix . "partida_nacimiento"]);
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["constancia_cuil"] = (is_null($row[$prefix . "constancia_cuil"])) ? null : settypebool($row[$prefix . "constancia_cuil"]);
    $row_["certificado_estudios"] = (is_null($row[$prefix . "certificado_estudios"])) ? null : settypebool($row[$prefix . "certificado_estudios"]);
    $row_["anio_ingreso"] = (is_null($row[$prefix . "anio_ingreso"])) ? null : intval($row[$prefix . "anio_ingreso"]);
    $row_["activo"] = (is_null($row[$prefix . "activo"])) ? null : settypebool($row[$prefix . "activo"]);
    $row_["programa"] = (is_null($row[$prefix . "programa"])) ? null : (string)$row[$prefix . "programa"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["comision"] = (is_null($row[$prefix . "comision"])) ? null : (string)$row[$prefix . "comision"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
