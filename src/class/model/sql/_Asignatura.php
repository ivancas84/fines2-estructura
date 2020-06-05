<?php
require_once("class/model/Sql.php");

class _AsignaturaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('asignatura');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombre': return $t.".nombre";
      case $p.'formacion': return $t.".formacion";
      case $p.'clasificacion': return $t.".clasificacion";
      case $p.'codigo': return $t.".codigo";
      case $p.'perfil': return $t.".perfil";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_nombre': return "MIN({$t}.nombre)";
      case $p.'max_nombre': return "MAX({$t}.nombre)";
      case $p.'count_nombre': return "COUNT({$t}.nombre)";

      case $p.'min_formacion': return "MIN({$t}.formacion)";
      case $p.'max_formacion': return "MAX({$t}.formacion)";
      case $p.'count_formacion': return "COUNT({$t}.formacion)";

      case $p.'min_clasificacion': return "MIN({$t}.clasificacion)";
      case $p.'max_clasificacion': return "MAX({$t}.clasificacion)";
      case $p.'count_clasificacion': return "COUNT({$t}.clasificacion)";

      case $p.'min_codigo': return "MIN({$t}.codigo)";
      case $p.'max_codigo': return "MAX({$t}.codigo)";
      case $p.'count_codigo': return "COUNT({$t}.codigo)";

      case $p.'min_perfil': return "MIN({$t}.perfil)";
      case $p.'max_perfil': return "MAX({$t}.perfil)";
      case $p.'count_perfil': return "COUNT({$t}.perfil)";

      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'formacion') . ' AS ' . $p.'formacion, ' . $this->_mappingField($p.'clasificacion') . ' AS ' . $p.'clasificacion, ' . $this->_mappingField($p.'codigo') . ' AS ' . $p.'codigo, ' . $this->_mappingField($p.'perfil') . ' AS ' . $p.'perfil';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'formacion') . ', ' . $this->_mappingField($p.'clasificacion') . ', ' . $this->_mappingField($p.'codigo') . ', ' . $this->_mappingField($p.'perfil') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}nombre": return $this->format->conditionText($f, $value, $option);
      case "{$p}formacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}clasificacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}codigo": return $this->format->conditionText($f, $value, $option);
      case "{$p}perfil": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_nombre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_nombre": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_nombre": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_formacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_formacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_formacion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_clasificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_clasificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_clasificacion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_codigo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_codigo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_codigo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_perfil": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_perfil": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_perfil": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('asignatura');
    if(!isset($data['nombre']) || is_null($data['nombre']) || $data['nombre'] == "") throw new Exception('dato obligatorio sin valor: nombre');
    if(!isset($data['formacion']) || is_null($data['formacion']) || $data['formacion'] == "") $data['formacion'] = "null";
    if(!isset($data['clasificacion']) || is_null($data['clasificacion']) || $data['clasificacion'] == "") $data['clasificacion'] = "null";
    if(!isset($data['codigo']) || is_null($data['codigo']) || $data['codigo'] == "") $data['codigo'] = "null";
    if(!isset($data['perfil']) || is_null($data['perfil']) || $data['perfil'] == "") $data['perfil'] = "null";

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('nombre', $data)) { if(is_null($data['nombre']) || $data['nombre'] == "") throw new Exception('dato obligatorio sin valor: nombre'); }
    if(array_key_exists('formacion', $data)) { if(is_null($data['formacion']) || $data['formacion'] == "") $data['formacion'] = "null"; }
    if(array_key_exists('clasificacion', $data)) { if(is_null($data['clasificacion']) || $data['clasificacion'] == "") $data['clasificacion'] = "null"; }
    if(array_key_exists('codigo', $data)) { if(is_null($data['codigo']) || $data['codigo'] == "") $data['codigo'] = "null"; }
    if(array_key_exists('perfil', $data)) { if(is_null($data['perfil']) || $data['perfil'] == "") $data['perfil'] = "null"; }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['nombre'])) $row_['nombre'] = $this->format->escapeString($row['nombre']);
    if(isset($row['formacion'])) $row_['formacion'] = $this->format->escapeString($row['formacion']);
    if(isset($row['clasificacion'])) $row_['clasificacion'] = $this->format->escapeString($row['clasificacion']);
    if(isset($row['codigo'])) $row_['codigo'] = $this->format->escapeString($row['codigo']);
    if(isset($row['perfil'])) $row_['perfil'] = $this->format->escapeString($row['perfil']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["nombre"] = (is_null($row[$prefix . "nombre"])) ? null : (string)$row[$prefix . "nombre"];
    $row_["formacion"] = (is_null($row[$prefix . "formacion"])) ? null : (string)$row[$prefix . "formacion"];
    $row_["clasificacion"] = (is_null($row[$prefix . "clasificacion"])) ? null : (string)$row[$prefix . "clasificacion"];
    $row_["codigo"] = (is_null($row[$prefix . "codigo"])) ? null : (string)$row[$prefix . "codigo"];
    $row_["perfil"] = (is_null($row[$prefix . "perfil"])) ? null : (string)$row[$prefix . "perfil"];
    return $row_;
  }



}
