<?php
require_once("class/model/Sql.php");

class AlumnoSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('alumno');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fotocopia_documento': return $t.".fotocopia_documento";
      case $p.'partida_nacimiento': return $t.".partida_nacimiento";
      case $p.'constancia_cuil': return $t.".constancia_cuil";
      case $p.'certificado_estudios': return $t.".certificado_estudios";
      case $p.'anio_ingreso': return $t.".anio_ingreso";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'persona': return $t.".persona";
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

      case $p.'sum_anio_ingreso': return "SUM({$t}.anio_ingreso)";
      case $p.'avg_anio_ingreso': return "AVG({$t}.anio_ingreso)";
      case $p.'min_anio_ingreso': return "MIN({$t}.anio_ingreso)";
      case $p.'max_anio_ingreso': return "MAX({$t}.anio_ingreso)";
      case $p.'count_anio_ingreso': return "COUNT({$t}.anio_ingreso)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'per')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'fotocopia_documento') . ' AS ' . $p.'fotocopia_documento, ' . $this->_mappingField($p.'partida_nacimiento') . ' AS ' . $p.'partida_nacimiento, ' . $this->_mappingField($p.'constancia_cuil') . ' AS ' . $p.'constancia_cuil, ' . $this->_mappingField($p.'certificado_estudios') . ' AS ' . $p.'certificado_estudios, ' . $this->_mappingField($p.'anio_ingreso') . ' AS ' . $p.'anio_ingreso, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'fotocopia_documento') . ', ' . $this->_mappingField($p.'partida_nacimiento') . ', ' . $this->_mappingField($p.'constancia_cuil') . ', ' . $this->_mappingField($p.'certificado_estudios') . ', ' . $this->_mappingField($p.'anio_ingreso') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'per')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('id_persona', 'per')->_join('persona', 'alum', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}fotocopia_documento": return $this->format->conditionBoolean($f, $value);
      case "{$p}partida_nacimiento": return $this->format->conditionBoolean($f, $value);
      case "{$p}constancia_cuil": return $this->format->conditionBoolean($f, $value);
      case "{$p}certificado_estudios": return $this->format->conditionBoolean($f, $value);
      case "{$p}anio_ingreso": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}persona": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','per')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('alumno');
    if(!isset($data['fotocopia_documento']) || ($data['fotocopia_documento'] == '')) $data['fotocopia_documento'] = "false";
    if(!isset($data['partida_nacimiento']) || ($data['partida_nacimiento'] == '')) $data['partida_nacimiento'] = "false";
    if(!isset($data['constancia_cuil']) || ($data['constancia_cuil'] == '')) $data['constancia_cuil'] = "false";
    if(!isset($data['certificado_estudios']) || ($data['certificado_estudios'] == '')) $data['certificado_estudios'] = "false";
    if(!isset($data['anio_ingreso']) || ($data['anio_ingreso'] == '')) $data['anio_ingreso'] = "null";
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('fotocopia_documento', $data)) { if(!isset($data['fotocopia_documento']) || ($data['fotocopia_documento'] == '')) $data['fotocopia_documento'] = "false"; }
    if(array_key_exists('partida_nacimiento', $data)) { if(!isset($data['partida_nacimiento']) || ($data['partida_nacimiento'] == '')) $data['partida_nacimiento'] = "false"; }
    if(array_key_exists('constancia_cuil', $data)) { if(!isset($data['constancia_cuil']) || ($data['constancia_cuil'] == '')) $data['constancia_cuil'] = "false"; }
    if(array_key_exists('certificado_estudios', $data)) { if(!isset($data['certificado_estudios']) || ($data['certificado_estudios'] == '')) $data['certificado_estudios'] = "false"; }
    if(array_key_exists('anio_ingreso', $data)) { if(!isset($data['anio_ingreso']) || ($data['anio_ingreso'] == '')) $data['anio_ingreso'] = "null"; }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }

  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['fotocopia_documento'])) $row_['fotocopia_documento'] = $this->format->boolean($row['fotocopia_documento']);
    if(isset($row['partida_nacimiento'])) $row_['partida_nacimiento'] = $this->format->boolean($row['partida_nacimiento']);
    if(isset($row['constancia_cuil'])) $row_['constancia_cuil'] = $this->format->boolean($row['constancia_cuil']);
    if(isset($row['certificado_estudios'])) $row_['certificado_estudios'] = $this->format->boolean($row['certificado_estudios']);
    if(isset($row['anio_ingreso'])) $row_['anio_ingreso'] = $this->format->numeric($row['anio_ingreso']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['persona']) ) $row_['persona'] = $this->format->positiveIntegerWithoutZerofill($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fotocopia_documento"] = (is_null($row[$prefix . "fotocopia_documento"])) ? null : settypebool($row[$prefix . "fotocopia_documento"]);
    $row_["partida_nacimiento"] = (is_null($row[$prefix . "partida_nacimiento"])) ? null : settypebool($row[$prefix . "partida_nacimiento"]);
    $row_["constancia_cuil"] = (is_null($row[$prefix . "constancia_cuil"])) ? null : settypebool($row[$prefix . "constancia_cuil"]);
    $row_["certificado_estudios"] = (is_null($row[$prefix . "certificado_estudios"])) ? null : settypebool($row[$prefix . "certificado_estudios"]);
    $row_["anio_ingreso"] = (is_null($row[$prefix . "anio_ingreso"])) ? null : intval($row[$prefix . "anio_ingreso"]);
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
