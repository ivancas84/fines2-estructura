<?php
require_once("class/model/Sql.php");

class NominaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('nomina');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'alta': return $t.".alta";
      case $p.'activo': return $t.".activo";
      case $p.'division': return $t.".division";
      case $p.'persona': return $t.".persona";
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

      case 'min_division': return "MIN({$t}.division)";
      case 'max_division': return "MAX({$t}.division)";
      case 'count_division': return "COUNT({$t}.division)";

      case 'min_persona': return "MIN({$t}.persona)";
      case 'max_persona': return "MAX({$t}.persona)";
      case 'count_persona': return "COUNT({$t}.persona)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('division', 'dia')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'dia_pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'dia_sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'dia_sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'dia_sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'dia_sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'dia_sed_ref')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'per')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'activo') . ' AS ' . $p.'activo, ' . $this->_mappingFieldEntity($p.'division') . ' AS ' . $p.'division, ' . $this->_mappingFieldEntity($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'alta') . ', ' . $this->_mappingFieldEntity($p.'activo') . ', ' . $this->_mappingFieldEntity($p.'division') . ', ' . $this->_mappingFieldEntity($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('division', 'dia')->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'dia_pla')->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'dia_sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'dia_sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'dia_sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'dia_sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'dia_sed_ref')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'per')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('division', 'dia')->_join('division', 'nomi', $render) . '
' . EntitySql::getInstanceFromString('plan', 'dia_pla')->_join('plan', 'dia', $render) . '
' . EntitySql::getInstanceFromString('sede', 'dia_sed')->_join('sede', 'dia', $render) . '
' . EntitySql::getInstanceFromString('sede', 'dia_sed_dep')->_join('dependencia', 'dia_sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'dia_sed_ts')->_join('tipo_sede', 'dia_sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'dia_sed_dom')->_join('domicilio', 'dia_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'dia_sed_coo')->_join('coordinador', 'dia_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'dia_sed_ref')->_join('referente', 'dia_sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'per')->_join('persona', 'nomi', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}activo": return $this->format->conditionBoolean($f, $value);
      case "{$p}division": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}persona": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','dia')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','dia_pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','dia_sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','dia_sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','dia_sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','dia_sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','dia_sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('division','dia')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','dia_pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','dia_sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','dia_sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','dia_sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','dia_sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','dia_sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('nomina');
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(!isset($data['activo']) || ($data['activo'] == '')) $data['activo'] = "true";
    if(empty($data['division'])) throw new Exception('dato obligatorio sin valor: division');
      if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('activo', $data)) { if(!isset($data['activo']) || ($data['activo'] == '')) $data['activo'] = "false"; }
    if(array_key_exists('division', $data)) { if(!isset($data['division']) || ($data['division'] == '')) throw new Exception('dato obligatorio sin valor: division'); }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['activo'])) $row_['activo'] = $this->format->boolean($row['activo']);
    if(isset($row['division']) ) $row_['division'] = $this->format->positiveIntegerWithoutZerofill($row['division']);
    if(isset($row['persona']) ) $row_['persona'] = $this->format->positiveIntegerWithoutZerofill($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["activo"] = (is_null($row[$prefix . "activo"])) ? null : settypebool($row[$prefix . "activo"]);
    $row_["division"] = (is_null($row[$prefix . "division"])) ? null : (string)$row[$prefix . "division"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
