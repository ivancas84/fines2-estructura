<?php
require_once("class/model/Sql.php");

class _CalendarioSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('calendario');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'inicio': return $t.".inicio";
      case $p.'fin': return $t.".fin";
      case $p.'anio': return $t.".anio";
      case $p.'semestre': return $t.".semestre";
      case $p.'insertado': return $t.".insertado";
      case $p.'insertado_date': return "CAST({$t}.insertado AS DATE)";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'avg_inicio': return "AVG({$t}.inicio)";
      case $p.'min_inicio': return "MIN({$t}.inicio)";
      case $p.'max_inicio': return "MAX({$t}.inicio)";
      case $p.'count_inicio': return "COUNT({$t}.inicio)";

      case $p.'avg_fin': return "AVG({$t}.fin)";
      case $p.'min_fin': return "MIN({$t}.fin)";
      case $p.'max_fin': return "MAX({$t}.fin)";
      case $p.'count_fin': return "COUNT({$t}.fin)";

      case $p.'min_anio': return "MIN({$t}.anio)";
      case $p.'max_anio': return "MAX({$t}.anio)";
      case $p.'count_anio': return "COUNT({$t}.anio)";

      case $p.'sum_semestre': return "SUM({$t}.semestre)";
      case $p.'avg_semestre': return "AVG({$t}.semestre)";
      case $p.'min_semestre': return "MIN({$t}.semestre)";
      case $p.'max_semestre': return "MAX({$t}.semestre)";
      case $p.'count_semestre': return "COUNT({$t}.semestre)";

      case $p.'avg_insertado': return "AVG({$t}.insertado)";
      case $p.'min_insertado': return "MIN({$t}.insertado)";
      case $p.'max_insertado': return "MAX({$t}.insertado)";
      case $p.'count_insertado': return "COUNT({$t}.insertado)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.inicio, {$t}.fin, {$t}.anio, {$t}.semestre)";
      default: return null;
    }
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'inicio') . ' AS ' . $p.'inicio, ' . $this->_mappingField($p.'fin') . ' AS ' . $p.'fin, ' . $this->_mappingField($p.'anio') . ' AS ' . $p.'anio, ' . $this->_mappingField($p.'semestre') . ' AS ' . $p.'semestre, ' . $this->_mappingField($p.'insertado') . ' AS ' . $p.'insertado';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'inicio') . ', ' . $this->_mappingField($p.'fin') . ', ' . $this->_mappingField($p.'anio') . ', ' . $this->_mappingField($p.'semestre') . ', ' . $this->_mappingField($p.'insertado') . '';
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}inicio": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}inicio"), $value, $option);

      case "{$p}fin": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fin"), $value, $option);

      case "{$p}anio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}anio"), $value, $option);

      case "{$p}semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}semestre"), $value, $option);

      case "{$p}insertado": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}insertado_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}insertado"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}avg_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_inicio"), $value, $option);

      case "{$p}max_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_inicio"), $value, $option);

      case "{$p}min_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_inicio"), $value, $option);

      case "{$p}count_inicio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_inicio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_inicio"), $value, $option);


      case "{$p}avg_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fin"), $value, $option);

      case "{$p}max_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fin"), $value, $option);

      case "{$p}min_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fin"), $value, $option);

      case "{$p}count_fin": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fin_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fin"), $value, $option);


      case "{$p}max_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_anio"), $value, $option);

      case "{$p}min_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_anio"), $value, $option);

      case "{$p}count_anio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_anio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_anio"), $value, $option);


      case "{$p}sum_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}sum_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}sum_semestre"), $value, $option);

      case "{$p}avg_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_semestre"), $value, $option);

      case "{$p}max_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_semestre"), $value, $option);

      case "{$p}min_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_semestre"), $value, $option);

      case "{$p}count_semestre": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_semestre_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_semestre"), $value, $option);


      case "{$p}avg_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_insertado"), $value, $option);

      case "{$p}max_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_insertado"), $value, $option);

      case "{$p}min_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_insertado"), $value, $option);

      case "{$p}count_insertado": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_insertado_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_insertado"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('inicio', $row)) $row_['inicio'] = $this->format->date($row['inicio']);
    if(array_key_exists('fin', $row)) $row_['fin'] = $this->format->date($row['fin']);
    if(array_key_exists('anio', $row)) $row_['anio'] = $this->format->year($row['anio']);
    if(array_key_exists('semestre', $row)) $row_['semestre'] = $this->format->numeric($row['semestre']);
    if(array_key_exists('insertado', $row)) $row_['insertado'] = $this->format->timestamp($row['insertado']);

    return $row_;
  }


}
