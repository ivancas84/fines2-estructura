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

      case $p.'_label': return "CONCAT_WS(' ', {$t}.nombre)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombre') . ' AS ' . $p.'nombre, ' . $this->_mappingField($p.'formacion') . ' AS ' . $p.'formacion, ' . $this->_mappingField($p.'clasificacion') . ' AS ' . $p.'clasificacion, ' . $this->_mappingField($p.'codigo') . ' AS ' . $p.'codigo, ' . $this->_mappingField($p.'perfil') . ' AS ' . $p.'perfil';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombre') . ', ' . $this->_mappingField($p.'formacion') . ', ' . $this->_mappingField($p.'clasificacion') . ', ' . $this->_mappingField($p.'codigo') . ', ' . $this->_mappingField($p.'perfil') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}nombre": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombre"), $value, $option);

      case "{$p}formacion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}formacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}formacion"), $value, $option);

      case "{$p}clasificacion": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}clasificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}clasificacion"), $value, $option);

      case "{$p}codigo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}codigo"), $value, $option);

      case "{$p}perfil": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}perfil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}perfil"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombre"), $value, $option);

      case "{$p}min_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombre"), $value, $option);

      case "{$p}count_nombre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombre"), $value, $option);


      case "{$p}max_formacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_formacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_formacion"), $value, $option);

      case "{$p}min_formacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_formacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_formacion"), $value, $option);

      case "{$p}count_formacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_formacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_formacion"), $value, $option);


      case "{$p}max_clasificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_clasificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_clasificacion"), $value, $option);

      case "{$p}min_clasificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_clasificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_clasificacion"), $value, $option);

      case "{$p}count_clasificacion": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_clasificacion_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_clasificacion"), $value, $option);


      case "{$p}max_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_codigo"), $value, $option);

      case "{$p}min_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_codigo"), $value, $option);

      case "{$p}count_codigo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_codigo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_codigo"), $value, $option);


      case "{$p}max_perfil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_perfil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_perfil"), $value, $option);

      case "{$p}min_perfil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_perfil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_perfil"), $value, $option);

      case "{$p}count_perfil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_perfil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_perfil"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('nombre', $row)) $row_['nombre'] = $this->format->string($row['nombre']);
    if(array_key_exists('formacion', $row)) $row_['formacion'] = $this->format->string($row['formacion']);
    if(array_key_exists('clasificacion', $row)) $row_['clasificacion'] = $this->format->string($row['clasificacion']);
    if(array_key_exists('codigo', $row)) $row_['codigo'] = $this->format->string($row['codigo']);
    if(array_key_exists('perfil', $row)) $row_['perfil'] = $this->format->string($row['perfil']);

    return $row_;
  }


}
