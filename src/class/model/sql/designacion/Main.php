<?php
require_once("class/model/Sql.php");

class DesignacionSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('designacion');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'desde': return $t.".desde";
      case $p.'hasta': return $t.".hasta";
      case $p.'alta': return $t.".alta";
      case $p.'cargo': return $t.".cargo";
      case $p.'sede': return $t.".sede";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_desde': return "AVG({$t}.desde)";
      case $p.'min_desde': return "MIN({$t}.desde)";
      case $p.'max_desde': return "MAX({$t}.desde)";
      case $p.'count_desde': return "COUNT({$t}.desde)";

      case $p.'avg_hasta': return "AVG({$t}.hasta)";
      case $p.'min_hasta': return "MIN({$t}.hasta)";
      case $p.'max_hasta': return "MAX({$t}.hasta)";
      case $p.'count_hasta': return "COUNT({$t}.hasta)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_cargo': return "MIN({$t}.cargo)";
      case $p.'max_cargo': return "MAX({$t}.cargo)";
      case $p.'count_cargo': return "COUNT({$t}.cargo)";

      case $p.'min_sede': return "MIN({$t}.sede)";
      case $p.'max_sede': return "MAX({$t}.sede)";
      case $p.'count_sede': return "COUNT({$t}.sede)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('cargo', 'car')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'sed_coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'per')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'desde') . ' AS ' . $p.'desde, ' . $this->_mappingField($p.'hasta') . ' AS ' . $p.'hasta, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'cargo') . ' AS ' . $p.'cargo, ' . $this->_mappingField($p.'sede') . ' AS ' . $p.'sede, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'desde') . ', ' . $this->_mappingField($p.'hasta') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'cargo') . ', ' . $this->_mappingField($p.'sede') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('cargo', 'car')->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'sed')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'sed_coo')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . '
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('cargo', 'car')->_join('cargo', 'desi', $render) . '
' . EntitySql::getInstanceRequire('sede', 'sed')->_join('sede', 'desi', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . EntitySql::getInstanceRequire('persona', 'sed_coo')->_join('coordinador', 'sed', $render) . '
' . EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'desi', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}desde": return $this->format->conditionDate($f, $value, $option);
      case "{$p}hasta": return $this->format->conditionDate($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}cargo": return $this->format->conditionText($f, $value, $option);
      case "{$p}sede": return $this->format->conditionText($f, $value, $option);
      case "{$p}persona": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_desde": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_desde": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_desde": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_desde": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_hasta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_hasta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_hasta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_hasta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_alta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_cargo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_cargo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_cargo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_sede": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_persona": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','car')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('cargo','car')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('designacion');
    if(!isset($data['desde']))  $data['desde'] = "null";
    if(!isset($data['hasta']))  $data['hasta'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");
    if(empty($data['cargo'])) throw new Exception('dato obligatorio sin valor: cargo');
    if(empty($data['sede'])) throw new Exception('dato obligatorio sin valor: sede');
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('desde', $data)) { if(empty($data['desde']))  $data['desde'] = "null"; }
    if(array_key_exists('hasta', $data)) { if(empty($data['hasta']))  $data['hasta'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('cargo', $data)) { if(!isset($data['cargo']) || ($data['cargo'] == '')) throw new Exception('dato obligatorio sin valor: cargo'); }
    if(array_key_exists('sede', $data)) { if(!isset($data['sede']) || ($data['sede'] == '')) throw new Exception('dato obligatorio sin valor: sede'); }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['desde'])) $row_['desde'] = $this->format->date($row['desde']);
    if(isset($row['hasta'])) $row_['hasta'] = $this->format->date($row['hasta']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['cargo'])) $row_['cargo'] = $this->format->escapeString($row['cargo']);
    if(isset($row['sede'])) $row_['sede'] = $this->format->escapeString($row['sede']);
    if(isset($row['persona'])) $row_['persona'] = $this->format->escapeString($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["desde"] = (is_null($row[$prefix . "desde"])) ? null : (string)$row[$prefix . "desde"];
    $row_["hasta"] = (is_null($row[$prefix . "hasta"])) ? null : (string)$row[$prefix . "hasta"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["cargo"] = (is_null($row[$prefix . "cargo"])) ? null : (string)$row[$prefix . "cargo"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["sede"] = (is_null($row[$prefix . "sede"])) ? null : (string)$row[$prefix . "sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
