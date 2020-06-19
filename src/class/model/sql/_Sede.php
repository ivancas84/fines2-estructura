<?php
require_once("class/model/Sql.php");

class _SedeSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('sede');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'numero': return $t.".numero";
      case $p.'nombre': return $t.".nombre";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'domicilio': return $t.".domicilio";
      case $p.'tipo_sede': return $t.".tipo_sede";
      case $p.'centro_educativo': return $t.".centro_educativo";
      case $p.'coordinador': return $t.".coordinador";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_numero': return "MIN({$t}.numero)";
      case $p.'max_numero': return "MAX({$t}.numero)";
      case $p.'count_numero': return "COUNT({$t}.numero)";

      case $p.'min_nombre': return "MIN({$t}.nombre)";
      case $p.'max_nombre': return "MAX({$t}.nombre)";
      case $p.'count_nombre': return "COUNT({$t}.nombre)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'avg_baja': return "AVG({$t}.baja)";
      case $p.'min_baja': return "MIN({$t}.baja)";
      case $p.'max_baja': return "MAX({$t}.baja)";
      case $p.'count_baja': return "COUNT({$t}.baja)";

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      case $p.'min_tipo_sede': return "MIN({$t}.tipo_sede)";
      case $p.'max_tipo_sede': return "MAX({$t}.tipo_sede)";
      case $p.'count_tipo_sede': return "COUNT({$t}.tipo_sede)";

      case $p.'min_centro_educativo': return "MIN({$t}.centro_educativo)";
      case $p.'max_centro_educativo': return "MAX({$t}.centro_educativo)";
      case $p.'count_centro_educativo': return "COUNT({$t}.centro_educativo)";

      case $p.'min_coordinador': return "MIN({$t}.coordinador)";
      case $p.'max_coordinador': return "MAX({$t}.coordinador)";
      case $p.'count_coordinador': return "COUNT({$t}.coordinador)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.numero, 
{$t}.nombre
)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('centro_educativo', 'ce')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'ce_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'coo_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio, ' . $this->_mappingField($p.'tipo_sede') . ' AS ' . $p.'tipo_sede, ' . $this->_mappingField($p.'centro_educativo') . ' AS ' . $p.'centro_educativo, ' . $this->_mappingField($p.'coordinador') . ' AS ' . $p.'coordinador';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'domicilio') . ', ' . $this->_mappingField($p.'tipo_sede') . ', ' . $this->_mappingField($p.'centro_educativo') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'ts')->_fields() . ',
' . EntitySql::getInstanceRequire('centro_educativo', 'ce')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'ce_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'coo')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'coo_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('domicilio', 'dom')->_join('domicilio', 'sede', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'ts')->_join('tipo_sede', 'sede', $render) . '
' . EntitySql::getInstanceRequire('centro_educativo', 'ce')->_join('centro_educativo', 'sede', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'ce_dom')->_join('domicilio', 'ce', $render) . '
' . EntitySql::getInstanceRequire('persona', 'coo')->_join('coordinador', 'sede', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'coo_dom')->_join('domicilio', 'coo', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombre": return $this->format->conditionText($f, $value, $option);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}domicilio": return $this->format->conditionText($f, $value, $option);
      case "{$p}tipo_sede": return $this->format->conditionText($f, $value, $option);
      case "{$p}centro_educativo": return $this->format->conditionText($f, $value, $option);
      case "{$p}coordinador": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_numero": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_numero": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_nombre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_nombre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_nombre": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_observaciones": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_alta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_baja": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_baja": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_baja": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_baja": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_domicilio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_domicilio": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_domicilio": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_tipo_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_tipo_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_tipo_sede": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_centro_educativo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_centro_educativo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_centro_educativo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_coordinador": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_coordinador": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_coordinador": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','coo_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','coo_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('sede');
    if(!isset($data['numero']) || is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero');
    if(!isset($data['nombre']) || is_null($data['nombre']) || $data['nombre'] == "") throw new Exception('dato obligatorio sin valor: nombre');
    if(!isset($data['observaciones']) || is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null";
    if(!isset($data['baja']))  $data['baja'] = "null";
    if(empty($data['domicilio'])) $data['domicilio'] = "null";
    if(empty($data['tipo_sede'])) $data['tipo_sede'] = "null";
    if(empty($data['centro_educativo'])) $data['centro_educativo'] = "null";

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('numero', $data)) { if(is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('nombre', $data)) { if(is_null($data['nombre']) || $data['nombre'] == "") throw new Exception('dato obligatorio sin valor: nombre'); }
    if(array_key_exists('observaciones', $data)) { if(is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null"; }
    if(array_key_exists('baja', $data)) { if(empty($data['baja']))  $data['baja'] = "null"; }
    if(array_key_exists('domicilio', $data)) { if(!isset($data['domicilio']) || ($data['domicilio'] == '')) $data['domicilio'] = "null"; }
    if(array_key_exists('tipo_sede', $data)) { if(!isset($data['tipo_sede']) || ($data['tipo_sede'] == '')) $data['tipo_sede'] = "null"; }
    if(array_key_exists('centro_educativo', $data)) { if(!isset($data['centro_educativo']) || ($data['centro_educativo'] == '')) $data['centro_educativo'] = "null"; }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->escapeString($row['numero']);
    if(isset($row['nombre'])) $row_['nombre'] = $this->format->escapeString($row['nombre']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['domicilio'])) $row_['domicilio'] = $this->format->escapeString($row['domicilio']);
    if(isset($row['tipo_sede'])) $row_['tipo_sede'] = $this->format->escapeString($row['tipo_sede']);
    if(isset($row['centro_educativo'])) $row_['centro_educativo'] = $this->format->escapeString($row['centro_educativo']);
    if(isset($row['coordinador']) ) $row_['coordinador'] = $this->format->positiveIntegerWithoutZerofill($row['coordinador']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : (string)$row[$prefix . "numero"];
    $row_["nombre"] = (is_null($row[$prefix . "nombre"])) ? null : (string)$row[$prefix . "nombre"];
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["domicilio"] = (is_null($row[$prefix . "domicilio"])) ? null : (string)$row[$prefix . "domicilio"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["tipo_sede"] = (is_null($row[$prefix . "tipo_sede"])) ? null : (string)$row[$prefix . "tipo_sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["centro_educativo"] = (is_null($row[$prefix . "centro_educativo"])) ? null : (string)$row[$prefix . "centro_educativo"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["coordinador"] = (is_null($row[$prefix . "coordinador"])) ? null : (string)$row[$prefix . "coordinador"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
