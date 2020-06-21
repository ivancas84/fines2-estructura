<?php
require_once("class/model/Sql.php");

class _DetallePersonaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('detalle_persona');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'descripcion': return $t.".descripcion";
      case $p.'creado': return $t.".creado";
      case $p.'file': return $t.".file";
      case $p.'persona': return $t.".persona";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_descripcion': return "MIN({$t}.descripcion)";
      case $p.'max_descripcion': return "MAX({$t}.descripcion)";
      case $p.'count_descripcion': return "COUNT({$t}.descripcion)";

      case $p.'avg_creado': return "AVG({$t}.creado)";
      case $p.'min_creado': return "MIN({$t}.creado)";
      case $p.'max_creado': return "MAX({$t}.creado)";
      case $p.'count_creado': return "COUNT({$t}.creado)";

      case $p.'min_file': return "MIN({$t}.file)";
      case $p.'max_file': return "MAX({$t}.file)";
      case $p.'count_file': return "COUNT({$t}.file)";

      case $p.'min_persona': return "MIN({$t}.persona)";
      case $p.'max_persona': return "MAX({$t}.persona)";
      case $p.'count_persona': return "COUNT({$t}.persona)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.id
)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('file', 'fil')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'per')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'per_dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'descripcion') . ' AS ' . $p.'descripcion, ' . $this->_mappingField($p.'creado') . ' AS ' . $p.'creado, ' . $this->_mappingField($p.'file') . ' AS ' . $p.'file, ' . $this->_mappingField($p.'persona') . ' AS ' . $p.'persona';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'descripcion') . ', ' . $this->_mappingField($p.'creado') . ', ' . $this->_mappingField($p.'file') . ', ' . $this->_mappingField($p.'persona') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('file', 'fil')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'per')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('file', 'fil')->_join('file', 'dp', $render) . '
' . EntitySql::getInstanceRequire('persona', 'per')->_join('persona', 'dp', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'per_dom')->_join('domicilio', 'per', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}descripcion": return $this->format->conditionText($f, $value, $option);
      case "{$p}creado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}file": return $this->format->conditionText($f, $value, $option);
      case "{$p}persona": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_descripcion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_descripcion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_descripcion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_creado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_creado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_file": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_file": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_file": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_persona": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_persona": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('file','fil')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('file','fil')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','per')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','per_dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('detalle_persona');
    if(!isset($data['descripcion']) || is_null($data['descripcion']) || $data['descripcion'] == "") throw new Exception('dato obligatorio sin valor: descripcion');
    if(!isset($data['creado']))  $data['creado'] = date("Y-m-d H:i:s");
    if(empty($data['file'])) $data['file'] = "null";
    if(empty($data['persona'])) throw new Exception('dato obligatorio sin valor: persona');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('descripcion', $data)) { if(is_null($data['descripcion']) || $data['descripcion'] == "") throw new Exception('dato obligatorio sin valor: descripcion'); }
    if(array_key_exists('creado', $data)) { if(empty($data['creado']))  $data['creado'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('file', $data)) { if(!isset($data['file']) || ($data['file'] == '')) $data['file'] = "null"; }
    if(array_key_exists('persona', $data)) { if(!isset($data['persona']) || ($data['persona'] == '')) throw new Exception('dato obligatorio sin valor: persona'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['descripcion'])) $row_['descripcion'] = $this->format->escapeString($row['descripcion']);
    if(isset($row['creado'])) $row_['creado'] = $this->format->timestamp($row['creado']);
    if(isset($row['file'])) $row_['file'] = $this->format->escapeString($row['file']);
    if(isset($row['persona'])) $row_['persona'] = $this->format->escapeString($row['persona']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["descripcion"] = (is_null($row[$prefix . "descripcion"])) ? null : (string)$row[$prefix . "descripcion"];
    $row_["creado"] = (is_null($row[$prefix . "creado"])) ? null : (string)$row[$prefix . "creado"];
    $row_["file"] = (is_null($row[$prefix . "file"])) ? null : (string)$row[$prefix . "file"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["persona"] = (is_null($row[$prefix . "persona"])) ? null : (string)$row[$prefix . "persona"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
