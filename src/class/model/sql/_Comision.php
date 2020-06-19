<?php
require_once("class/model/Sql.php");

class _ComisionSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('comision');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'turno': return $t.".turno";
      case $p.'division': return $t.".division";
      case $p.'comentario': return $t.".comentario";
      case $p.'autorizada': return $t.".autorizada";
      case $p.'apertura': return $t.".apertura";
      case $p.'publicada': return $t.".publicada";
      case $p.'observaciones': return $t.".observaciones";
      case $p.'alta': return $t.".alta";
      case $p.'sede': return $t.".sede";
      case $p.'modalidad': return $t.".modalidad";
      case $p.'planificacion': return $t.".planificacion";
      case $p.'comision_siguiente': return $t.".comision_siguiente";
      case $p.'calendario': return $t.".calendario";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_turno': return "MIN({$t}.turno)";
      case $p.'max_turno': return "MAX({$t}.turno)";
      case $p.'count_turno': return "COUNT({$t}.turno)";

      case $p.'min_division': return "MIN({$t}.division)";
      case $p.'max_division': return "MAX({$t}.division)";
      case $p.'count_division': return "COUNT({$t}.division)";

      case $p.'min_comentario': return "MIN({$t}.comentario)";
      case $p.'max_comentario': return "MAX({$t}.comentario)";
      case $p.'count_comentario': return "COUNT({$t}.comentario)";

      case $p.'min_autorizada': return "MIN({$t}.autorizada)";
      case $p.'max_autorizada': return "MAX({$t}.autorizada)";
      case $p.'count_autorizada': return "COUNT({$t}.autorizada)";

      case $p.'min_apertura': return "MIN({$t}.apertura)";
      case $p.'max_apertura': return "MAX({$t}.apertura)";
      case $p.'count_apertura': return "COUNT({$t}.apertura)";

      case $p.'min_publicada': return "MIN({$t}.publicada)";
      case $p.'max_publicada': return "MAX({$t}.publicada)";
      case $p.'count_publicada': return "COUNT({$t}.publicada)";

      case $p.'min_observaciones': return "MIN({$t}.observaciones)";
      case $p.'max_observaciones': return "MAX({$t}.observaciones)";
      case $p.'count_observaciones': return "COUNT({$t}.observaciones)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_sede': return "MIN({$t}.sede)";
      case $p.'max_sede': return "MAX({$t}.sede)";
      case $p.'count_sede': return "COUNT({$t}.sede)";

      case $p.'min_modalidad': return "MIN({$t}.modalidad)";
      case $p.'max_modalidad': return "MAX({$t}.modalidad)";
      case $p.'count_modalidad': return "COUNT({$t}.modalidad)";

      case $p.'min_planificacion': return "MIN({$t}.planificacion)";
      case $p.'max_planificacion': return "MAX({$t}.planificacion)";
      case $p.'count_planificacion': return "COUNT({$t}.planificacion)";

      case $p.'min_comision_siguiente': return "MIN({$t}.comision_siguiente)";
      case $p.'max_comision_siguiente': return "MAX({$t}.comision_siguiente)";
      case $p.'count_comision_siguiente': return "COUNT({$t}.comision_siguiente)";

      case $p.'min_calendario': return "MIN({$t}.calendario)";
      case $p.'max_calendario': return "MAX({$t}.calendario)";
      case $p.'count_calendario': return "COUNT({$t}.calendario)";

      case $p.'_label': return "CONCAT_WS(' ',
{$t}.division, 
{$p}sed.numero, 
{$p}sed.nombre, 
{$p}pla.anio, 
{$p}pla.semestre, 
{$p}pla_plb.orientacion, 
{$p}pla_plb.distribucion_horaria, 
{$p}cal.inicio, 
{$p}cal.fin, 
{$p}cal.anio, 
{$p}cal.semestre
)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('sede', 'sed')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('persona', 'sed_coo')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'sed_coo_dom')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('modalidad', 'moa')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('planificacion', 'pla')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('plan', 'pla_plb')->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('calendario', 'cal')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'turno') . ' AS ' . $p.'turno, ' . $this->_mappingField($p.'division') . ' AS ' . $p.'division, ' . $this->_mappingField($p.'comentario') . ' AS ' . $p.'comentario, ' . $this->_mappingField($p.'autorizada') . ' AS ' . $p.'autorizada, ' . $this->_mappingField($p.'apertura') . ' AS ' . $p.'apertura, ' . $this->_mappingField($p.'publicada') . ' AS ' . $p.'publicada, ' . $this->_mappingField($p.'observaciones') . ' AS ' . $p.'observaciones, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'sede') . ' AS ' . $p.'sede, ' . $this->_mappingField($p.'modalidad') . ' AS ' . $p.'modalidad, ' . $this->_mappingField($p.'planificacion') . ' AS ' . $p.'planificacion, ' . $this->_mappingField($p.'comision_siguiente') . ' AS ' . $p.'comision_siguiente, ' . $this->_mappingField($p.'calendario') . ' AS ' . $p.'calendario';
  }

  public function _fieldsDb(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'turno') . ', ' . $this->_mappingField($p.'division') . ', ' . $this->_mappingField($p.'comentario') . ', ' . $this->_mappingField($p.'autorizada') . ', ' . $this->_mappingField($p.'apertura') . ', ' . $this->_mappingField($p.'publicada') . ', ' . $this->_mappingField($p.'observaciones') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'sede') . ', ' . $this->_mappingField($p.'modalidad') . ', ' . $this->_mappingField($p.'planificacion') . ', ' . $this->_mappingField($p.'comision_siguiente') . ', ' . $this->_mappingField($p.'calendario') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('sede', 'sed')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_fields() . ',
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('persona', 'sed_coo')->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'sed_coo_dom')->_fields() . ',
' . EntitySql::getInstanceRequire('modalidad', 'moa')->_fields() . ',
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_fields() . ',
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_fields() . ',
' . EntitySql::getInstanceRequire('calendario', 'cal')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('sede', 'sed')->_join('sede', 'comi', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_dom')->_join('domicilio', 'sed', $render) . '
' . EntitySql::getInstanceRequire('tipo_sede', 'sed_ts')->_join('tipo_sede', 'sed', $render) . '
' . EntitySql::getInstanceRequire('centro_educativo', 'sed_ce')->_join('centro_educativo', 'sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_ce_dom')->_join('domicilio', 'sed_ce', $render) . '
' . EntitySql::getInstanceRequire('persona', 'sed_coo')->_join('coordinador', 'sed', $render) . '
' . EntitySql::getInstanceRequire('domicilio', 'sed_coo_dom')->_join('domicilio', 'sed_coo', $render) . '
' . EntitySql::getInstanceRequire('modalidad', 'moa')->_join('modalidad', 'comi', $render) . '
' . EntitySql::getInstanceRequire('planificacion', 'pla')->_join('planificacion', 'comi', $render) . '
' . EntitySql::getInstanceRequire('plan', 'pla_plb')->_join('plan', 'pla', $render) . '
' . EntitySql::getInstanceRequire('calendario', 'cal')->_join('calendario', 'comi', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    $f = $this->_mappingField($field);
    switch ($field){
      case "{$p}id": return $this->format->conditionText($f, $value, $option);
      case "{$p}turno": return $this->format->conditionText($f, $value, $option);
      case "{$p}division": return $this->format->conditionText($f, $value, $option);
      case "{$p}comentario": return $this->format->conditionText($f, $value, $option);
      case "{$p}autorizada": return $this->format->conditionBoolean($f, $value);
      case "{$p}apertura": return $this->format->conditionBoolean($f, $value);
      case "{$p}publicada": return $this->format->conditionBoolean($f, $value);
      case "{$p}observaciones": return $this->format->conditionText($f, $value, $option);
      case "{$p}alta": return $this->format->conditionTimestamp($f, $value, $option);
      case "{$p}sede": return $this->format->conditionText($f, $value, $option);
      case "{$p}modalidad": return $this->format->conditionText($f, $value, $option);
      case "{$p}planificacion": return $this->format->conditionText($f, $value, $option);
      case "{$p}comision_siguiente": return $this->format->conditionText($f, $value, $option);
      case "{$p}calendario": return $this->format->conditionText($f, $value, $option);

      case "{$p}max_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_id": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_id": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_turno": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_turno": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_turno": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_division": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_division": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_division": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_comentario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_comentario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_comentario": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_autorizada": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_autorizada": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_autorizada": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_apertura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_apertura": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_apertura": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_publicada": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_publicada": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_publicada": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_observaciones": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_observaciones": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}avg_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}max_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_alta": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_alta": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_sede": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_sede": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_modalidad": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_modalidad": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_modalidad": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_planificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_planificacion": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_planificacion": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_comision_siguiente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_comision_siguiente": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_comision_siguiente": return $this->format->conditionNumber($f, $value, $option);

      case "{$p}max_calendario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}min_calendario": return $this->format->conditionNumber($f, $value, $option);
      case "{$p}count_calendario": return $this->format->conditionNumber($f, $value, $option);

      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','sed_coo')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_coo_dom')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','moa')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cal')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('sede','sed')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('tipo_sede','sed_ts')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('centro_educativo','sed_ce')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_ce_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('persona','sed_coo')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','sed_coo_dom')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('modalidad','moa')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('planificacion','pla')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('plan','pla_plb')->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('calendario','cal')->_conditionFieldAux($field, $option, $value)) return $c;
  }

  public function initializeInsert(array $data){
    $data['id'] = (!empty($data['id'])) ? $data['id'] : Ma::nextId('comision');
    if(!isset($data['turno']) || is_null($data['turno']) || $data['turno'] == "") $data['turno'] = "null";
    if(!isset($data['division']) || is_null($data['division']) || $data['division'] == "") throw new Exception('dato obligatorio sin valor: division');
    if(!isset($data['comentario']) || is_null($data['comentario']) || $data['comentario'] == "") $data['comentario'] = "null";
    if(!isset($data['autorizada']) || ($data['autorizada'] == '')) $data['autorizada'] = "false";
    if(!isset($data['apertura']) || ($data['apertura'] == '')) $data['apertura'] = "false";
    if(!isset($data['publicada']) || ($data['publicada'] == '')) $data['publicada'] = "false";
    if(!isset($data['observaciones']) || is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null";
    if(empty($data['sede'])) throw new Exception('dato obligatorio sin valor: sede');
    if(empty($data['modalidad'])) throw new Exception('dato obligatorio sin valor: modalidad');
    if(empty($data['planificacion'])) $data['planificacion'] = "null";
    if(empty($data['comision_siguiente'])) $data['comision_siguiente'] = "null";
    if(empty($data['calendario'])) throw new Exception('dato obligatorio sin valor: calendario');

    return $data;
  }


  public function initializeUpdate(array $data){
    if(array_key_exists('id', $data)) { if(is_null($data['id']) || $data['id'] == "") throw new Exception('dato obligatorio sin valor: id'); }
    if(array_key_exists('turno', $data)) { if(is_null($data['turno']) || $data['turno'] == "") $data['turno'] = "null"; }
    if(array_key_exists('division', $data)) { if(is_null($data['division']) || $data['division'] == "") throw new Exception('dato obligatorio sin valor: division'); }
    if(array_key_exists('comentario', $data)) { if(is_null($data['comentario']) || $data['comentario'] == "") $data['comentario'] = "null"; }
    if(array_key_exists('autorizada', $data)) { if(!isset($data['autorizada']) || ($data['autorizada'] == '')) $data['autorizada'] = "false"; }
    if(array_key_exists('apertura', $data)) { if(!isset($data['apertura']) || ($data['apertura'] == '')) $data['apertura'] = "false"; }
    if(array_key_exists('publicada', $data)) { if(!isset($data['publicada']) || ($data['publicada'] == '')) $data['publicada'] = "false"; }
    if(array_key_exists('observaciones', $data)) { if(is_null($data['observaciones']) || $data['observaciones'] == "") $data['observaciones'] = "null"; }
    if(array_key_exists('sede', $data)) { if(!isset($data['sede']) || ($data['sede'] == '')) throw new Exception('dato obligatorio sin valor: sede'); }
    if(array_key_exists('modalidad', $data)) { if(!isset($data['modalidad']) || ($data['modalidad'] == '')) throw new Exception('dato obligatorio sin valor: modalidad'); }
    if(array_key_exists('planificacion', $data)) { if(!isset($data['planificacion']) || ($data['planificacion'] == '')) $data['planificacion'] = "null"; }
    if(array_key_exists('comision_siguiente', $data)) { if(!isset($data['comision_siguiente']) || ($data['comision_siguiente'] == '')) $data['comision_siguiente'] = "null"; }
    if(array_key_exists('calendario', $data)) { if(!isset($data['calendario']) || ($data['calendario'] == '')) throw new Exception('dato obligatorio sin valor: calendario'); }

    return $data;
  }


  public function format(array $row){
    $row_ = array();
   if(isset($row['id']) )  $row_['id'] = $this->format->escapeString($row['id']);
    if(isset($row['turno'])) $row_['turno'] = $this->format->escapeString($row['turno']);
    if(isset($row['division'])) $row_['division'] = $this->format->escapeString($row['division']);
    if(isset($row['comentario'])) $row_['comentario'] = $this->format->escapeString($row['comentario']);
    if(isset($row['autorizada'])) $row_['autorizada'] = $this->format->boolean($row['autorizada']);
    if(isset($row['apertura'])) $row_['apertura'] = $this->format->boolean($row['apertura']);
    if(isset($row['publicada'])) $row_['publicada'] = $this->format->boolean($row['publicada']);
    if(isset($row['observaciones'])) $row_['observaciones'] = $this->format->escapeString($row['observaciones']);
    if(isset($row['alta'])) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(isset($row['sede'])) $row_['sede'] = $this->format->escapeString($row['sede']);
    if(isset($row['modalidad'])) $row_['modalidad'] = $this->format->escapeString($row['modalidad']);
    if(isset($row['planificacion'])) $row_['planificacion'] = $this->format->escapeString($row['planificacion']);
    if(isset($row['comision_siguiente'])) $row_['comision_siguiente'] = $this->format->escapeString($row['comision_siguiente']);
    if(isset($row['calendario'])) $row_['calendario'] = $this->format->escapeString($row['calendario']);

    return $row_;
  }
  public function _json(array $row = NULL){
    if(empty($row)) return null;
    $prefix = $this->prf();
    $row_ = [];
    $row_["id"] = (is_null($row[$prefix . "id"])) ? null : (string)$row[$prefix . "id"]; //la pk se trata como string debido a un comportamiento erratico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["turno"] = (is_null($row[$prefix . "turno"])) ? null : (string)$row[$prefix . "turno"];
    $row_["division"] = (is_null($row[$prefix . "division"])) ? null : (string)$row[$prefix . "division"];
    $row_["comentario"] = (is_null($row[$prefix . "comentario"])) ? null : (string)$row[$prefix . "comentario"];
    $row_["autorizada"] = (is_null($row[$prefix . "autorizada"])) ? null : settypebool($row[$prefix . "autorizada"]);
    $row_["apertura"] = (is_null($row[$prefix . "apertura"])) ? null : settypebool($row[$prefix . "apertura"]);
    $row_["publicada"] = (is_null($row[$prefix . "publicada"])) ? null : settypebool($row[$prefix . "publicada"]);
    $row_["observaciones"] = (is_null($row[$prefix . "observaciones"])) ? null : (string)$row[$prefix . "observaciones"];
    $row_["alta"] = (is_null($row[$prefix . "alta"])) ? null : (string)$row[$prefix . "alta"];
    $row_["sede"] = (is_null($row[$prefix . "sede"])) ? null : (string)$row[$prefix . "sede"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["modalidad"] = (is_null($row[$prefix . "modalidad"])) ? null : (string)$row[$prefix . "modalidad"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["planificacion"] = (is_null($row[$prefix . "planificacion"])) ? null : (string)$row[$prefix . "planificacion"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["comision_siguiente"] = (is_null($row[$prefix . "comision_siguiente"])) ? null : (string)$row[$prefix . "comision_siguiente"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    $row_["calendario"] = (is_null($row[$prefix . "calendario"])) ? null : (string)$row[$prefix . "calendario"]; //las fk se transforman a string debido a un comportamiento errantico en angular 2 que al tratarlo como integer resta 1 en el valor
    return $row_;
  }



}
