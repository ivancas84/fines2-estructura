<?php
require_once("class/model/Sql.php");

class CoordinadorSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('coordinador');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'sede': return $t.".sede";
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

      case 'avg_baja': return "AVG({$t}.baja)";
      case 'min_baja': return "MIN({$t}.baja)";
      case 'max_baja': return "MAX({$t}.baja)";
      case 'count_baja': return "COUNT({$t}.baja)";

      case 'min_sede': return "MIN({$t}.sede)";
      case 'max_sede': return "MAX({$t}.sede)";
      case 'count_sede': return "COUNT({$t}.sede)";

      case 'min_persona': return "MIN({$t}.persona)";
      case 'max_persona': return "MAX({$t}.persona)";
      case 'count_persona': return "COUNT({$t}.persona)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('sede', 'sed')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_mappingFieldEntity($field)) return $f;
    if($f = EntitySql::getInstanceFromString('id_persona', 'per')->_mappingFieldEntity($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingFieldEntity($p.'sede') . ' AS ' . $p.'sede, ' . $this->_mappingFieldEntity($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'alta') . ', ' . $this->_mappingFieldEntity($p.'baja') . ', ' . $this->_mappingFieldEntity($p.'sede') . ', ' . $this->_mappingFieldEntity($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceFromString('sede', 'sed')->_fields() . ',
' . EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_fields() . ',
' . EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_fields() . ',
' . EntitySql::getInstanceFromString('id_persona', 'per')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceFromString('sede', 'sed')->_join('sede', 'coor', $render) . '
' . EntitySql::getInstanceFromString('sede', 'sed_dep')->_join('dependencia', 'sed', $render) . '
' . EntitySql::getInstanceFromString('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . EntitySql::getInstanceFromString('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'sed_coo')->_join('coordinador', 'sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'sed_ref')->_join('referente', 'sed', $render) . '
' . EntitySql::getInstanceFromString('id_persona', 'per')->_join('persona', 'coor', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}persona": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_ref')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','sed_ref')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceFromString('id_persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('coordinador');
    if(empty($data['sede'])) throw new Exception('dato obligatorio sin valor: sede');
      if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('sede', $data)) { if(!isset($data['sede']) || ($data['sede'] == '')) throw new Exception('dato obligatorio sin valor: sede'); }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['sede']) ) $row_['sede'] = $this->format->positiveIntegerWithoutZerofill($row['sede']);
    if(isset($row['persona']) ) $row_['persona'] = $this->format->positiveIntegerWithoutZerofill($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["sede"] = (is_null($row[$prefix . "sede"])) ? null : (string)$row[$prefix . "sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
