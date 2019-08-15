<?php
require_once("class/model/Sql.php");

class DivisionSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('division');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'serie': return $t.".serie";
      case $p.'turno': return $t.".turno";
      case $p.'numero': return $t.".numero";
      case $p.'plan': return $t.".plan";
      case $p.'sede': return $t.".sede";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'min_plan': return "MIN({$t}.plan)";
      case 'max_plan': return "MAX({$t}.plan)";
      case 'count_plan': return "COUNT({$t}.plan)";

      case 'min_sede': return "MIN({$t}.sede)";
      case 'max_sede': return "MAX({$t}.sede)";
      case 'count_sede': return "COUNT({$t}.sede)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('plan', 'pla')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'serie') . ' AS ' . $p.'serie, ' . $this->_mappingFieldEntity($p.'turno') . ' AS ' . $p.'turno, ' . $this->_mappingFieldEntity($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingFieldEntity($p.'plan') . ' AS ' . $p.'plan, ' . $this->_mappingFieldEntity($p.'sede') . ' AS ' . $p.'sede';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'serie') . ', ' . $this->_mappingFieldEntity($p.'turno') . ', ' . $this->_mappingFieldEntity($p.'plan') . ', ' . $this->_mappingFieldEntity($p.'sede') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('plan', 'pla')->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('plan', 'pla')->_join('plan', 'divi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'sed')->_join('sede', 'divi', $render) . '
' . EntitySql::getInstanceFromString('sede', 'sed_dep')->_join('dependencia', 'sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_join('coordinador', 'sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_join('referente', 'sed', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}serie": return $this->format->conditionText($f, $value, $option);
      case "{$p}turno": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero": return $this->format->conditionText($f, $value, $option);
      case "{$p}plan": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}sede": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('plan','pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('division');
    if(empty($data['serie'])) throw new Exception('dato obligatorio sin valor: serie');
    if(empty($data['turno'])) $data['turno'] = "null";
    if(empty($data['plan'])) throw new Exception('dato obligatorio sin valor: plan');
      if(empty($data['sede'])) throw new Exception('dato obligatorio sin valor: sede');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('serie', $data)) { if(empty($data['serie'])) throw new Exception('dato obligatorio sin valor: serie'); }
    if(array_key_exists('turno', $data)) { if(empty($data['turno'])) $data['turno'] = "null"; }
    if(array_key_exists('plan', $data)) { if(!isset($data['plan']) || ($data['plan'] == '')) throw new Exception('dato obligatorio sin valor: plan'); }
    if(array_key_exists('sede', $data)) { if(!isset($data['sede']) || ($data['sede'] == '')) throw new Exception('dato obligatorio sin valor: sede'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['serie'])) $row_['serie'] = $this->format->escapeString($row['serie']);
    if(isset($row['turno'])) $row_['turno'] = $this->format->escapeString($row['turno']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->escapeString($row['numero']);
    if(isset($row['plan']) ) $row_['plan'] = $this->format->positiveIntegerWithoutZerofill($row['plan']);
    if(isset($row['sede']) ) $row_['sede'] = $this->format->positiveIntegerWithoutZerofill($row['sede']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["serie"] = (is_null($row[$prefix . "serie"])) ? null : (string)$row[$prefix . "serie"];
    $row_["turno"] = (is_null($row[$prefix . "turno"])) ? null : (string)$row[$prefix . "turno"];
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : (string)$row[$prefix . "numero"];
    $row_["plan"] = (is_null($row[$prefix . "plan"])) ? null : (string)$row[$prefix . "plan"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["sede"] = (is_null($row[$prefix . "sede"])) ? null : (string)$row[$prefix . "sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
