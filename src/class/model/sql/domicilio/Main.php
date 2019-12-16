<?php
require_once("class/model/Sql.php");

class DomicilioSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('domicilio');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'calle': return $t.".calle";
      case $p.'entre': return $t.".entre";
      case $p.'numero': return $t.".numero";
      case $p.'piso': return $t.".piso";
      case $p.'departamento': return $t.".departamento";
      case $p.'barrio': return $t.".barrio";
      case $p.'localidad': return $t.".localidad";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'calle') . ' AS ' . $p.'calle, ' . $this->_mappingField($p.'entre') . ' AS ' . $p.'entre, ' . $this->_mappingField($p.'numero') . ' AS ' . $p.'numero, ' . $this->_mappingField($p.'piso') . ' AS ' . $p.'piso, ' . $this->_mappingField($p.'departamento') . ' AS ' . $p.'departamento, ' . $this->_mappingField($p.'barrio') . ' AS ' . $p.'barrio, ' . $this->_mappingField($p.'localidad') . ' AS ' . $p.'localidad';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'calle') . ', ' . $this->_mappingField($p.'entre') . ', ' . $this->_mappingField($p.'numero') . ', ' . $this->_mappingField($p.'piso') . ', ' . $this->_mappingField($p.'departamento') . ', ' . $this->_mappingField($p.'barrio') . ', ' . $this->_mappingField($p.'localidad') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}calle": return $this->format->conditionText($f, $value, $option);
      case "{$p}entre": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero": return $this->format->conditionText($f, $value, $option);
      case "{$p}piso": return $this->format->conditionText($f, $value, $option);
      case "{$p}departamento": return $this->format->conditionText($f, $value, $option);
      case "{$p}barrio": return $this->format->conditionText($f, $value, $option);
      case "{$p}localidad": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('domicilio');
    if(!isset($data['calle']) || is_null($data['calle']) || $data['calle'] == "") throw new Exception('dato obligatorio sin valor: calle');
    if(!isset($data['entre']) || is_null($data['entre']) || $data['entre'] == "") $data['entre'] = "null";
    if(!isset($data['numero']) || is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero');
    if(!isset($data['piso']) || is_null($data['piso']) || $data['piso'] == "") $data['piso'] = "null";
    if(!isset($data['departamento']) || is_null($data['departamento']) || $data['departamento'] == "") $data['departamento'] = "null";
    if(!isset($data['barrio']) || is_null($data['barrio']) || $data['barrio'] == "") $data['barrio'] = "null";
    if(!isset($data['localidad']) || is_null($data['localidad']) || $data['localidad'] == "") throw new Exception('dato obligatorio sin valor: localidad');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('calle', $data)) { if(is_null($data['calle']) || $data['calle'] == "") throw new Exception('dato obligatorio sin valor: calle'); }
    if(array_key_exists('entre', $data)) { if(is_null($data['entre']) || $data['entre'] == "") $data['entre'] = "null"; }
    if(array_key_exists('numero', $data)) { if(is_null($data['numero']) || $data['numero'] == "") throw new Exception('dato obligatorio sin valor: numero'); }
    if(array_key_exists('piso', $data)) { if(is_null($data['piso']) || $data['piso'] == "") $data['piso'] = "null"; }
    if(array_key_exists('departamento', $data)) { if(is_null($data['departamento']) || $data['departamento'] == "") $data['departamento'] = "null"; }
    if(array_key_exists('barrio', $data)) { if(is_null($data['barrio']) || $data['barrio'] == "") $data['barrio'] = "null"; }
    if(array_key_exists('localidad', $data)) { if(is_null($data['localidad']) || $data['localidad'] == "") throw new Exception('dato obligatorio sin valor: localidad'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['calle'])) $row_['calle'] = $this->format->escapeString($row['calle']);
    if(isset($row['entre'])) $row_['entre'] = $this->format->escapeString($row['entre']);
    if(isset($row['numero'])) $row_['numero'] = $this->format->escapeString($row['numero']);
    if(isset($row['piso'])) $row_['piso'] = $this->format->escapeString($row['piso']);
    if(isset($row['departamento'])) $row_['departamento'] = $this->format->escapeString($row['departamento']);
    if(isset($row['barrio'])) $row_['barrio'] = $this->format->escapeString($row['barrio']);
    if(isset($row['localidad'])) $row_['localidad'] = $this->format->escapeString($row['localidad']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["calle"] = (is_null($row[$prefix . "calle"])) ? null : (string)$row[$prefix . "calle"];
    $row_["entre"] = (is_null($row[$prefix . "entre"])) ? null : (string)$row[$prefix . "entre"];
    $row_["numero"] = (is_null($row[$prefix . "numero"])) ? null : (string)$row[$prefix . "numero"];
    $row_["piso"] = (is_null($row[$prefix . "piso"])) ? null : (string)$row[$prefix . "piso"];
    $row_["departamento"] = (is_null($row[$prefix . "departamento"])) ? null : (string)$row[$prefix . "departamento"];
    $row_["barrio"] = (is_null($row[$prefix . "barrio"])) ? null : (string)$row[$prefix . "barrio"];
    $row_["localidad"] = (is_null($row[$prefix . "localidad"])) ? null : (string)$row[$prefix . "localidad"];
    return $row_;
  }



}
