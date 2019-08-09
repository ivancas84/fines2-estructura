<?php
require_once("class/model/Sql.php");

class IdPersonaSqlMain extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceFromString('id_persona');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombres': return $t.".nombres";
      case $p.'apellidos': return $t.".apellidos";
      case $p.'sobrenombre': return $t.".sobrenombre";
      case $p.'fecha_nacimiento': return $t.".fecha_nacimiento";
      case $p.'tipo_documento': return $t.".tipo_documento";
      case $p.'numero_documento': return $t.".numero_documento";
      case $p.'email': return $t.".email";
      case $p.'genero': return $t.".genero";
      case $p.'cuil': return $t.".cuil";
      case $p.'alta': return $t.".alta";
      case $p.'telefonos': return $t.".telefonos";
      default: return null;
    }
  }

  public function _mappingFieldAggregate($field){
    $t = $this->entity->getAlias();

    switch ($field) {
      case 'min_id': return "MIN({$t}.id)";
      case 'max_id': return "MAX({$t}.id)";
      case 'count_id': return "COUNT({$t}.id)";

      case 'avg_fecha_nacimiento': return "AVG({$t}.fecha_nacimiento)";
      case 'min_fecha_nacimiento': return "MIN({$t}.fecha_nacimiento)";
      case 'max_fecha_nacimiento': return "MAX({$t}.fecha_nacimiento)";
      case 'count_fecha_nacimiento': return "COUNT({$t}.fecha_nacimiento)";

      case 'avg_alta': return "AVG({$t}.alta)";
      case 'min_alta': return "MIN({$t}.alta)";
      case 'max_alta': return "MAX({$t}.alta)";
      case 'count_alta': return "COUNT({$t}.alta)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingFieldEntity($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingFieldEntity($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingFieldEntity($p.'sobrenombre') . ' AS ' . $p.'sobrenombre, ' . $this->_mappingFieldEntity($p.'fecha_nacimiento') . ' AS ' . $p.'fecha_nacimiento, ' . $this->_mappingFieldEntity($p.'tipo_documento') . ' AS ' . $p.'tipo_documento, ' . $this->_mappingFieldEntity($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingFieldEntity($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingFieldEntity($p.'genero') . ' AS ' . $p.'genero, ' . $this->_mappingFieldEntity($p.'cuil') . ' AS ' . $p.'cuil, ' . $this->_mappingFieldEntity($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingFieldEntity($p.'telefonos') . ' AS ' . $p.'telefonos';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingFieldEntity($p.'id') . ', ' . $this->_mappingFieldEntity($p.'nombres') . ', ' . $this->_mappingFieldEntity($p.'apellidos') . ', ' . $this->_mappingFieldEntity($p.'sobrenombre') . ', ' . $this->_mappingFieldEntity($p.'fecha_nacimiento') . ', ' . $this->_mappingFieldEntity($p.'tipo_documento') . ', ' . $this->_mappingFieldEntity($p.'numero_documento') . ', ' . $this->_mappingFieldEntity($p.'email') . ', ' . $this->_mappingFieldEntity($p.'genero') . ', ' . $this->_mappingFieldEntity($p.'cuil') . ', ' . $this->_mappingFieldEntity($p.'alta') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingFieldEntity($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}nombres": return $this->format->conditionText($f, $value, $option);
      case "{$p}apellidos": return $this->format->conditionText($f, $value, $option);
      case "{$p}sobrenombre": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_nacimiento": return $this->format->conditionDate($f, $value, $option);
      case "{$p}tipo_documento": return $this->format->conditionText($f, $value, $option);
      case "{$p}numero_documento": return $this->format->conditionText($f, $value, $option);
      case "{$p}email": return $this->format->conditionText($f, $value, $option);
      case "{$p}genero": return $this->format->conditionText($f, $value, $option);
      case "{$p}cuil": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}telefonos": return $this->format->conditionText($f, $value, $option);
      default: return parent::_conditionFieldStruct($field, $option, $value);
    }
  }


  //@override
  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Dba::nextId('id_persona');
    if(empty($data['nombres'])) throw new Exception('dato obligatorio sin valor: nombres');
    if(empty($data['apellidos'])) throw new Exception('dato obligatorio sin valor: apellidos');
    if(empty($data['sobrenombre'])) $data['sobrenombre'] = "null";
    if(!isset($data['fecha_nacimiento']))  $data['fecha_nacimiento'] = "null";
    if(empty($data['tipo_documento'])) $data['tipo_documento'] = "DNI";
    if(empty($data['numero_documento'])) throw new Exception('dato obligatorio sin valor: numero_documento');
    if(empty($data['email'])) $data['email'] = "null";
    if(empty($data['genero'])) throw new Exception('dato obligatorio sin valor: genero');
    if(empty($data['cuil'])) $data['cuil'] = "null";
    if(!isset($data['alta']))  $data['alta'] = date("Y-m-d H:i:s");

    return $data;
  }

  //@override
  public function initializeUpdate(array $data){
    if(array_key_exists('nombres', $data)) { if(empty($data['nombres'])) throw new Exception('dato obligatorio sin valor: nombres'); }
    if(array_key_exists('apellidos', $data)) { if(empty($data['apellidos'])) throw new Exception('dato obligatorio sin valor: apellidos'); }
    if(array_key_exists('sobrenombre', $data)) { if(empty($data['sobrenombre'])) $data['sobrenombre'] = "null"; }
    if(array_key_exists('fecha_nacimiento', $data)) { if(empty($data['fecha_nacimiento']))  $data['fecha_nacimiento'] = "null"; }
    if(array_key_exists('tipo_documento', $data)) { if(empty($data['tipo_documento'])) $data['tipo_documento'] = "DNI"; }
    if(array_key_exists('numero_documento', $data)) { if(empty($data['numero_documento'])) throw new Exception('dato obligatorio sin valor: numero_documento'); }
    if(array_key_exists('email', $data)) { if(empty($data['email'])) $data['email'] = "null"; }
    if(array_key_exists('genero', $data)) { if(empty($data['genero'])) throw new Exception('dato obligatorio sin valor: genero'); }
    if(array_key_exists('cuil', $data)) { if(empty($data['cuil'])) $data['cuil'] = "null"; }
    if(array_key_exists('alta', $data)) { if(empty($data['alta']))  $data['alta'] = date("Y-m-d H:i:s"); }

    return $data;
  }

  //Formato SQL
  public function format(array $row){
    $row_ = array();
    if(isset($row['id']) ) $row_['id'] = $this->format->positiveIntegerWithoutZerofill($row['id']);
    if(isset($row['nombres'])) $row_['nombres'] = $this->format->escapeString($row['nombres']);
    if(isset($row['apellidos'])) $row_['apellidos'] = $this->format->escapeString($row['apellidos']);
    if(isset($row['sobrenombre'])) $row_['sobrenombre'] = $this->format->escapeString($row['sobrenombre']);
    if(isset($row['fecha_nacimiento'])) $row_['fecha_nacimiento'] = $this->format->date($row['fecha_nacimiento']);
    if(isset($row['tipo_documento'])) $row_['tipo_documento'] = $this->format->escapeString($row['tipo_documento']);
    if(isset($row['numero_documento'])) $row_['numero_documento'] = $this->format->escapeString($row['numero_documento']);
    if(isset($row['email'])) $row_['email'] = $this->format->escapeString($row['email']);
    if(isset($row['genero'])) $row_['genero'] = $this->format->escapeString($row['genero']);
    if(isset($row['cuil'])) $row_['cuil'] = $this->format->escapeString($row['cuil']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['telefonos'])) $row_['telefonos'] = $this->format->escapeString($row['telefonos']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nombres"] = (is_null($row[$prefix . "nombres"])) ? null : (string)$row[$prefix . "nombres"];
    $row_["apellidos"] = (is_null($row[$prefix . "apellidos"])) ? null : (string)$row[$prefix . "apellidos"];
    $row_["sobrenombre"] = (is_null($row[$prefix . "sobrenombre"])) ? null : (string)$row[$prefix . "sobrenombre"];
    $row_["fecha_nacimiento"] = (is_null($row[$prefix . "fecha_nacimiento"])) ? null : (string)$row[$prefix . "fecha_nacimiento"];
    $row_["tipo_documento"] = (is_null($row[$prefix . "tipo_documento"])) ? null : (string)$row[$prefix . "tipo_documento"];
    $row_["numero_documento"] = (is_null($row[$prefix . "numero_documento"])) ? null : (string)$row[$prefix . "numero_documento"];
    $row_["email"] = (is_null($row[$prefix . "email"])) ? null : (string)$row[$prefix . "email"];
    $row_["genero"] = (is_null($row[$prefix . "genero"])) ? null : (string)$row[$prefix . "genero"];
    $row_["cuil"] = (is_null($row[$prefix . "cuil"])) ? null : (string)$row[$prefix . "cuil"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["telefonos"] = (is_null($row[$prefix . "telefonos"])) ? null : (string)$row[$prefix . "telefonos"];
    return $row_;
  }



}
