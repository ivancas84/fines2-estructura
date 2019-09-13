<?php
require_once("class/model/Sql.php");

class SedeSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('sede');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'nombre': return $t.".nombre";
      case $p.'organizacion': return $t.".organizacion";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'tipo': return $t.".tipo";
      case $p.'baja': return $t.".baja";
      case $p.'dependencia': return $t.".dependencia";
      case $p.'tipo_sede': return $t.".tipo_sede";
      case $p.'domicilio': return $t.".domicilio";
      case $p.'coordinador': return $t.".coordinador";
      case $p.'referente': return $t.".referente";
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

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'min_dependencia': return "MIN({$t}.dependencia)";
      case $p.'max_dependencia': return "MAX({$t}.dependencia)";
      case $p.'count_dependencia': return "COUNT({$t}.dependencia)";

      case $p.'min_tipo_sede': return "MIN({$t}.tipo_sede)";
      case $p.'max_tipo_sede': return "MAX({$t}.tipo_sede)";
      case $p.'count_tipo_sede': return "COUNT({$t}.tipo_sede)";

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      case $p.'min_coordinador': return "MIN({$t}.coordinador)";
      case $p.'max_coordinador': return "MAX({$t}.coordinador)";
      case $p.'count_coordinador': return "COUNT({$t}.coordinador)";

      case $p.'min_referente': return "MIN({$t}.referente)";
      case $p.'max_referente': return "MAX({$t}.referente)";
      case $p.'count_referente': return "COUNT({$t}.referente)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'ref')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'organizacion') . ' AS ' . $p.'organizacion, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'tipo') . ' AS ' . $p.'tipo, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'dependencia') . ' AS ' . $p.'dependencia, ' . $this->_mappingField($p.'tipo_sede') . ' AS ' . $p.'tipo_sede, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio, ' . $this->_mappingField($p.'coordinador') . ' AS ' . $p.'coordinador, ' . $this->_mappingField($p.'referente') . ' AS ' . $p.'referente';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'organizacion') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'tipo') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'dependencia') . ', ' . $this->_mappingField($p.'tipo_sede') . ', ' . $this->_mappingField($p.'domicilio') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'ts')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'coo')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'ref')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('sede', 'dep')->_join('dependencia', 'sede', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'ts')->_join('tipo_sede', 'sede', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_join('domicilio', 'sede', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'coo')->_join('coordinador', 'sede', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'ref')->_join('referente', 'sede', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}numero": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombre": return $this->format->conditionText($f, $value, $option);
      case "{$p}organizacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}tipo": return $this->format->conditionText($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}dependencia": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}tipo_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}domicilio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}coordinador": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}referente": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ref')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ref')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  protected function conditionFieldHaving($field, $option, $value) {
    if($c = $this->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','ts')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','coo')->_conditionFieldHaving($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ref')->_conditionFieldHaving($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('sede');
    if(empty($data['numero'])) $data['numero'] = "null";
    if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre');
    if(empty($data['organizacion'])) $data['organizacion'] = "null";
    if(empty($data['observaciones'])) $data['observaciones'] = "null";
    if(empty($data['tipo'])) $data['tipo'] = "null";
    if(!isset($data['baja']))  $data['baja'] = "null";
    if(empty($data['dependencia'])) $data['dependencia'] = "null";
      if(empty($data['tipo_sede'])) $data['tipo_sede'] = "null";
      if(empty($data['domicilio'])) $data['domicilio'] = "null";
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('numero', $data)) { if(empty($data['numero'])) $data['numero'] = "null"; }
    if(array_key_exists('nombre', $data)) { if(empty($data['nombre'])) throw new Exception('dato obligatorio sin valor: nombre'); }
    if(array_key_exists('organizacion', $data)) { if(empty($data['organizacion'])) $data['organizacion'] = "null"; }
    if(array_key_exists('observaciones', $data)) { if(empty($data['observaciones'])) $data['observaciones'] = "null"; }
    if(array_key_exists('tipo', $data)) { if(empty($data['tipo'])) $data['tipo'] = "null"; }
    if(array_key_exists('baja', $data)) { if(empty($data['baja']))  $data['baja'] = "null"; }
    if(array_key_exists('dependencia', $data)) { if(!isset($data['dependencia']) || ($data['dependencia'] == '')) $data['dependencia'] = "null"; }
    if(array_key_exists('tipo_sede', $data)) { if(!isset($data['tipo_sede']) || ($data['tipo_sede'] == '')) $data['tipo_sede'] = "null"; }
    if(array_key_exists('domicilio', $data)) { if(!isset($data['domicilio']) || ($data['domicilio'] == '')) $data['domicilio'] = "null"; }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->escapeString($row['numero']);
    if(isset($row['nombre'])) $row_['nombre'] = $this->format->escapeString($row['nombre']);
    if(isset($row['organizacion'])) $row_['organizacion'] = $this->format->escapeString($row['organizacion']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['tipo'])) $row_['tipo'] = $this->format->escapeString($row['tipo']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['dependencia']) ) $row_['dependencia'] = $this->format->positiveIntegerWithoutZerofill($row['dependencia']);
    if(isset($row['tipo_sede']) ) $row_['tipo_sede'] = $this->format->positiveIntegerWithoutZerofill($row['tipo_sede']);
    if(isset($row['domicilio']) ) $row_['domicilio'] = $this->format->positiveIntegerWithoutZerofill($row['domicilio']);
    if(isset($row['coordinador']) ) $row_['coordinador'] = $this->format->positiveIntegerWithoutZerofill($row['coordinador']);
    if(isset($row['referente']) ) $row_['referente'] = $this->format->positiveIntegerWithoutZerofill($row['referente']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : (string)$row[$prefix . "numero"];
    $row_["nombre"] = (is_null($row[$prefix . "nombre"])) ? null : (string)$row[$prefix . "nombre"];
    $row_["organizacion"] = (is_null($row[$prefix . "organizacion"])) ? null : (string)$row[$prefix . "organizacion"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["tipo"] = (is_null($row[$prefix . "tipo"])) ? null : (string)$row[$prefix . "tipo"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["dependencia"] = (is_null($row[$prefix . "dependencia"])) ? null : (string)$row[$prefix . "dependencia"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["tipo_sede"] = (is_null($row[$prefix . "tipo_sede"])) ? null : (string)$row[$prefix . "tipo_sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["domicilio"] = (is_null($row[$prefix . "domicilio"])) ? null : (string)$row[$prefix . "domicilio"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["coordinador"] = (is_null($row[$prefix . "coordinador"])) ? null : (string)$row[$prefix . "coordinador"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["referente"] = (is_null($row[$prefix . "referente"])) ? null : (string)$row[$prefix . "referente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
