<?php
require_once("class/model/Sql.php");

class _ContralorSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('contralor');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'fecha_contralor': return $t.".fecha_contralor";
      case $p.'fecha_consejo': return $t.".fecha_consejo";
      case $p.'insertado': return $t.".insertado";
      case $p.'planilla_docente': return $t.".planilla_docente";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_fecha_contralor': return "AVG({$t}.fecha_contralor)";
      case $p.'min_fecha_contralor': return "MIN({$t}.fecha_contralor)";
      case $p.'max_fecha_contralor': return "MAX({$t}.fecha_contralor)";
      case $p.'count_fecha_contralor': return "COUNT({$t}.fecha_contralor)";

      case $p.'avg_fecha_consejo': return "AVG({$t}.fecha_consejo)";
      case $p.'min_fecha_consejo': return "MIN({$t}.fecha_consejo)";
      case $p.'max_fecha_consejo': return "MAX({$t}.fecha_consejo)";
      case $p.'count_fecha_consejo': return "COUNT({$t}.fecha_consejo)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'min_planilla_docente': return "MIN({$t}.planilla_docente)";
      case $p.'max_planilla_docente': return "MAX({$t}.planilla_docente)";
      case $p.'count_planilla_docente': return "COUNT({$t}.planilla_docente)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.id
)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planilla_docente', 'pd')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'fecha_contralor') . ' AS ' . $p.'fecha_contralor, ' . $this->_mappingField($p.'fecha_consejo') . ' AS ' . $p.'fecha_consejo, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado, ' . $this->_mappingField($p.'planilla_docente') . ' AS ' . $p.'planilla_docente';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'fecha_contralor') . ', ' . $this->_mappingField($p.'fecha_consejo') . ', ' . $this->_mappingField($p.'insertado') . ', ' . $this->_mappingField($p.'planilla_docente') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('planilla_docente', 'pd')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('planilla_docente', 'pd')->_join('planilla_docente', 'cont', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}fecha_contralor": return $this->format->conditionDate($f, $value, $option);
      case "{$p}fecha_consejo": return $this->format->conditionDate($f, $value, $option);
      case "{$p}insertado": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}planilla_docente": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_fecha_contralor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_fecha_contralor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_fecha_contralor": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_fecha_contralor": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_fecha_consejo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_fecha_consejo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_fecha_consejo": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_fecha_consejo": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_insertado": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_insertado": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_planilla_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_planilla_docente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_planilla_docente": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planilla_docente','pd')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planilla_docente','pd')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('contralor');
    if(!isset($data['fecha_contralor']))  $data['fecha_contralor'] = "null";
    if(!isset($data['fecha_consejo']))  $data['fecha_consejo'] = "null";
    if(!isset($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s");
    if(empty($data['planilla_docente'])) throw new Exception('dato obligatorio sin valor: planilla_docente');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('fecha_contralor', $data)) { if(empty($data['fecha_contralor']))  $data['fecha_contralor'] = "null"; }
    if(array_key_exists('fecha_consejo', $data)) { if(empty($data['fecha_consejo']))  $data['fecha_consejo'] = "null"; }
    if(array_key_exists('insertado', $data)) { if(empty($data['insertado']))  $data['insertado'] = date("Y-m-d H:i:s"); }
    if(array_key_exists('planilla_docente', $data)) { if(!isset($data['planilla_docente']) || ($data['planilla_docente'] == '')) throw new Exception('dato obligatorio sin valor: planilla_docente'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['fecha_contralor'])) $row_['fecha_contralor'] = $this->format->date($row['fecha_contralor']);
    if(isset($row['fecha_consejo'])) $row_['fecha_consejo'] = $this->format->date($row['fecha_consejo']);
    if(isset($row['insertado'])) $row_['insertado'] = $this->format->timestamp($row['insertado']);
    if(isset($row['planilla_docente'])) $row_['planilla_docente'] = $this->format->escapeString($row['planilla_docente']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["fecha_contralor"] = (is_null($row[$prefix . "fecha_contralor"])) ? null : (string)$row[$prefix . "fecha_contralor"];
    $row_["fecha_consejo"] = (is_null($row[$prefix . "fecha_consejo"])) ? null : (string)$row[$prefix . "fecha_consejo"];
    $row_["insertado"] = (is_null($row[$prefix . "insertado"])) ? null : (string)$row[$prefix . "insertado"];
    $row_["planilla_docente"] = (is_null($row[$prefix . "planilla_docente"])) ? null : (string)$row[$prefix . "planilla_docente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
