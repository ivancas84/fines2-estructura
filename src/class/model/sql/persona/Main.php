<?php
require_once("class/model/Sql.php");

class PersonaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('persona');
  }


  public function _mappingFieldStruct($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'alta': return $t.".alta";
      case $p.'baja': return $t.".baja";
      case $p.'lugar_nacimiento': return $t.".lugar_nacimiento";
      case $p.'id_persona': return $t.".id_persona";
      case $p.'domicilio': return $t.".domicilio";
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

      case 'min_lugar_nacimiento': return "MIN({$t}.lugar_nacimiento)";
      case 'max_lugar_nacimiento': return "MAX({$t}.lugar_nacimiento)";
      case 'count_lugar_nacimiento': return "COUNT({$t}.lugar_nacimiento)";

      case 'min_id_persona': return "MIN({$t}.id_persona)";
      case 'max_id_persona': return "MAX({$t}.id_persona)";
      case 'count_id_persona': return "COUNT({$t}.id_persona)";

      case 'min_domicilio': return "MIN({$t}.domicilio)";
      case 'max_domicilio': return "MAX({$t}.domicilio)";
      case 'count_domicilio': return "COUNT({$t}.domicilio)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('lugar_nacimiento', 'ln')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('id_persona', 'ip')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido " . $field);
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'baja') . ' AS ' . $p.'baja, ' . $this->_mappingField($p.'lugar_nacimiento') . ' AS ' . $p.'lugar_nacimiento, ' . $this->_mappingField($p.'id_persona') . ' AS ' . $p.'id_persona, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'baja') . ', ' . $this->_mappingField($p.'lugar_nacimiento') . ', ' . $this->_mappingField($p.'id_persona') . ', ' . $this->_mappingField($p.'domicilio') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('lugar_nacimiento', 'ln')->_fields() . ',
' . EntitySql::getInstanceRequire('id_persona', 'ip')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('lugar_nacimiento', 'ln')->_join('lugar_nacimiento', 'pers', $render) . '
' . EntitySql::getInstanceRequire('id_persona', 'ip')->_join('id_persona', 'pers', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_join('domicilio', 'pers', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}baja": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}lugar_nacimiento": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}id_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}domicilio": return $this->format->conditionNumber($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('lugar_nacimiento','ln')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ip')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('lugar_nacimiento','ln')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('id_persona','ip')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('persona');
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['lugar_nacimiento'])) $data['lugar_nacimiento'] = "null";
      if(empty($data['id_persona'])) throw new Exception('dato obligatorio sin valor: id_persona');
      if(empty($data['domicilio'])) $data['domicilio'] = "null";
  
    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(!isset($data['id']) || ($data['id'] == '')) throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('lugar_nacimiento', $data)) { if(!isset($data['lugar_nacimiento']) || ($data['lugar_nacimiento'] == '')) $data['lugar_nacimiento'] = "null"; }
    if(array_key_exists('id_persona', $data)) { if(!isset($data['id_persona']) || ($data['id_persona'] == '')) throw new Exception('dato obligatorio sin valor: id_persona'); }
    if(array_key_exists('domicilio', $data)) { if(!isset($data['domicilio']) || ($data['domicilio'] == '')) $data['domicilio'] = "null"; }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['baja'])) $row_['baja'] = $this->format->timestamp($row['baja']);
    if(isset($row['lugar_nacimiento']) ) $row_['lugar_nacimiento'] = $this->format->positiveIntegerWithoutZerofill($row['lugar_nacimiento']);
    if(isset($row['id_persona']) ) $row_['id_persona'] = $this->format->positiveIntegerWithoutZerofill($row['id_persona']);
    if(isset($row['domicilio']) ) $row_['domicilio'] = $this->format->positiveIntegerWithoutZerofill($row['domicilio']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["baja"] = (is_null($row[$prefix . "baja"])) ? null : (string)$row[$prefix . "baja"];
    $row_["lugar_nacimiento"] = (is_null($row[$prefix . "lugar_nacimiento"])) ? null : (string)$row[$prefix . "lugar_nacimiento"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["id_persona"] = (is_null($row[$prefix . "id_persona"])) ? null : (string)$row[$prefix . "id_persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["domicilio"] = (is_null($row[$prefix . "domicilio"])) ? null : (string)$row[$prefix . "domicilio"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
