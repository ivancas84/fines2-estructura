<?php
require_once("class/model/Sql.php");

class _PersonaSql extends EntitySql{

  public function __construct(){
    parent::__construct();
    $this->entity = Entity::getInstanceRequire('persona');
  }


  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    if($f = $this->_mappingFieldMain($field)) return $f;
    switch ($field) {
      case $p.'id': return $t.".id";
      case $p.'nombres': return $t.".nombres";
      case $p.'apellidos': return $t.".apellidos";
      case $p.'fecha_nacimiento': return $t.".fecha_nacimiento";
      case $p.'numero_documento': return $t.".numero_documento";
      case $p.'cuil': return $t.".cuil";
      case $p.'genero': return $t.".genero";
      case $p.'apodo': return $t.".apodo";
      case $p.'telefono': return $t.".telefono";
      case $p.'email': return $t.".email";
      case $p.'alta': return $t.".alta";
      case $p.'alta_date': return "CAST({$t}.alta AS DATE)";
      case $p.'domicilio': return $t.".domicilio";

      case $p.'min_id': return "MIN({$t}.id)";
      case $p.'max_id': return "MAX({$t}.id)";
      case $p.'count_id': return "COUNT({$t}.id)";

      case $p.'min_nombres': return "MIN({$t}.nombres)";
      case $p.'max_nombres': return "MAX({$t}.nombres)";
      case $p.'count_nombres': return "COUNT({$t}.nombres)";

      case $p.'min_apellidos': return "MIN({$t}.apellidos)";
      case $p.'max_apellidos': return "MAX({$t}.apellidos)";
      case $p.'count_apellidos': return "COUNT({$t}.apellidos)";

      case $p.'avg_fecha_nacimiento': return "AVG({$t}.fecha_nacimiento)";
      case $p.'min_fecha_nacimiento': return "MIN({$t}.fecha_nacimiento)";
      case $p.'max_fecha_nacimiento': return "MAX({$t}.fecha_nacimiento)";
      case $p.'count_fecha_nacimiento': return "COUNT({$t}.fecha_nacimiento)";

      case $p.'min_numero_documento': return "MIN({$t}.numero_documento)";
      case $p.'max_numero_documento': return "MAX({$t}.numero_documento)";
      case $p.'count_numero_documento': return "COUNT({$t}.numero_documento)";

      case $p.'min_cuil': return "MIN({$t}.cuil)";
      case $p.'max_cuil': return "MAX({$t}.cuil)";
      case $p.'count_cuil': return "COUNT({$t}.cuil)";

      case $p.'min_genero': return "MIN({$t}.genero)";
      case $p.'max_genero': return "MAX({$t}.genero)";
      case $p.'count_genero': return "COUNT({$t}.genero)";

      case $p.'min_apodo': return "MIN({$t}.apodo)";
      case $p.'max_apodo': return "MAX({$t}.apodo)";
      case $p.'count_apodo': return "COUNT({$t}.apodo)";

      case $p.'min_telefono': return "MIN({$t}.telefono)";
      case $p.'max_telefono': return "MAX({$t}.telefono)";
      case $p.'count_telefono': return "COUNT({$t}.telefono)";

      case $p.'min_email': return "MIN({$t}.email)";
      case $p.'max_email': return "MAX({$t}.email)";
      case $p.'count_email': return "COUNT({$t}.email)";

      case $p.'avg_alta': return "AVG({$t}.alta)";
      case $p.'min_alta': return "MIN({$t}.alta)";
      case $p.'max_alta': return "MAX({$t}.alta)";
      case $p.'count_alta': return "COUNT({$t}.alta)";

      case $p.'min_domicilio': return "MIN({$t}.domicilio)";
      case $p.'max_domicilio': return "MAX({$t}.domicilio)";
      case $p.'count_domicilio': return "COUNT({$t}.domicilio)";

      case $p.'_label': return "CONCAT_WS(' ', {$t}.nombres, {$t}.apellidos, {$t}.numero_documento)";
      default: return null;
    }
  }

  public function mappingField($field){
    if($f = $this->_mappingField($field)) return $f;
    if($f = EntitySql::getInstanceRequire('domicilio', 'dom')->_mappingField($field)) return $f;
    throw new Exception("Campo no reconocido para {$this->entity->getName()}: {$field}");
  }

  public function _fields(){
    //No todos los campos se extraen de la entidad, por eso es necesario mapearlos
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ' AS ' . $p.'id, ' . $this->_mappingField($p.'nombres') . ' AS ' . $p.'nombres, ' . $this->_mappingField($p.'apellidos') . ' AS ' . $p.'apellidos, ' . $this->_mappingField($p.'fecha_nacimiento') . ' AS ' . $p.'fecha_nacimiento, ' . $this->_mappingField($p.'numero_documento') . ' AS ' . $p.'numero_documento, ' . $this->_mappingField($p.'cuil') . ' AS ' . $p.'cuil, ' . $this->_mappingField($p.'genero') . ' AS ' . $p.'genero, ' . $this->_mappingField($p.'apodo') . ' AS ' . $p.'apodo, ' . $this->_mappingField($p.'telefono') . ' AS ' . $p.'telefono, ' . $this->_mappingField($p.'email') . ' AS ' . $p.'email, ' . $this->_mappingField($p.'alta') . ' AS ' . $p.'alta, ' . $this->_mappingField($p.'domicilio') . ' AS ' . $p.'domicilio';
  }

  public function _fieldsExclusive(){
    $p = $this->prf();
    return '
' . $this->_mappingField($p.'id') . ', ' . $this->_mappingField($p.'nombres') . ', ' . $this->_mappingField($p.'apellidos') . ', ' . $this->_mappingField($p.'fecha_nacimiento') . ', ' . $this->_mappingField($p.'numero_documento') . ', ' . $this->_mappingField($p.'cuil') . ', ' . $this->_mappingField($p.'genero') . ', ' . $this->_mappingField($p.'apodo') . ', ' . $this->_mappingField($p.'telefono') . ', ' . $this->_mappingField($p.'email') . ', ' . $this->_mappingField($p.'alta') . ', ' . $this->_mappingField($p.'domicilio') . '';
  }

  public function fields(){
    return $this->_fields() . ',
' . EntitySql::getInstanceRequire('domicilio', 'dom')->_fields() . ' 
';
  }

  public function join(Render $render){
    return EntitySql::getInstanceRequire('domicilio', 'dom')->_join('domicilio', 'pers', $render) . '
' ;
  }

  public function _conditionFieldStruct($field, $option, $value){
    $p = $this->prf();

    switch ($field){
      case "{$p}id": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}id"), $value, $option);

      case "{$p}nombres": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}nombres"), $value, $option);

      case "{$p}apellidos": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}apellidos"), $value, $option);

      case "{$p}fecha_nacimiento": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}fecha_nacimiento"), $value, $option);

      case "{$p}numero_documento": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}numero_documento"), $value, $option);

      case "{$p}cuil": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}cuil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}cuil"), $value, $option);

      case "{$p}genero": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}genero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}genero"), $value, $option);

      case "{$p}apodo": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}apodo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}apodo"), $value, $option);

      case "{$p}telefono": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}telefono_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}telefono"), $value, $option);

      case "{$p}email": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}email"), $value, $option);

      case "{$p}alta": return $this->format->conditionTimestamp($this->_mappingField($field), $value, $option);
      case "{$p}alta_date": return $this->format->conditionDate($this->_mappingField($field), $value, $option);
      case "{$p}alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}alta"), $value, $option);

      case "{$p}domicilio": return $this->format->conditionText($this->_mappingField($field), $value, $option);
      case "{$p}domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}domicilio"), $value, $option);


      case "{$p}max_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_id"), $value, $option);

      case "{$p}min_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_id"), $value, $option);

      case "{$p}count_id": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_id_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_id"), $value, $option);


      case "{$p}max_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_nombres"), $value, $option);

      case "{$p}min_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_nombres"), $value, $option);

      case "{$p}count_nombres": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_nombres_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_nombres"), $value, $option);


      case "{$p}max_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_apellidos"), $value, $option);

      case "{$p}min_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_apellidos"), $value, $option);

      case "{$p}count_apellidos": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_apellidos_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_apellidos"), $value, $option);


      case "{$p}avg_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_fecha_nacimiento"), $value, $option);

      case "{$p}max_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_fecha_nacimiento"), $value, $option);

      case "{$p}min_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_fecha_nacimiento"), $value, $option);

      case "{$p}count_fecha_nacimiento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_fecha_nacimiento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_fecha_nacimiento"), $value, $option);


      case "{$p}max_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_numero_documento"), $value, $option);

      case "{$p}min_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_numero_documento"), $value, $option);

      case "{$p}count_numero_documento": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_numero_documento_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_numero_documento"), $value, $option);


      case "{$p}max_cuil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_cuil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_cuil"), $value, $option);

      case "{$p}min_cuil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_cuil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_cuil"), $value, $option);

      case "{$p}count_cuil": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_cuil_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_cuil"), $value, $option);


      case "{$p}max_genero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_genero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_genero"), $value, $option);

      case "{$p}min_genero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_genero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_genero"), $value, $option);

      case "{$p}count_genero": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_genero_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_genero"), $value, $option);


      case "{$p}max_apodo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_apodo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_apodo"), $value, $option);

      case "{$p}min_apodo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_apodo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_apodo"), $value, $option);

      case "{$p}count_apodo": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_apodo_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_apodo"), $value, $option);


      case "{$p}max_telefono": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_telefono_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_telefono"), $value, $option);

      case "{$p}min_telefono": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_telefono_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_telefono"), $value, $option);

      case "{$p}count_telefono": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_telefono_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_telefono"), $value, $option);


      case "{$p}max_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_email"), $value, $option);

      case "{$p}min_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_email"), $value, $option);

      case "{$p}count_email": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_email_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_email"), $value, $option);


      case "{$p}avg_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}avg_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}avg_alta"), $value, $option);

      case "{$p}max_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_alta"), $value, $option);

      case "{$p}min_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_alta"), $value, $option);

      case "{$p}count_alta": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_alta_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_alta"), $value, $option);


      case "{$p}max_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}max_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}max_domicilio"), $value, $option);

      case "{$p}min_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}min_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}min_domicilio"), $value, $option);

      case "{$p}count_domicilio": return $this->format->conditionNumber($this->_mappingField($field), $value, $option);
      case "{$p}count_domicilio_is_set": return $this->format->conditionIsSet($this->_mappingField("{$p}count_domicilio"), $value, $option);


      default: return $this->_conditionFieldStructMain($field, $option, $value);
    }
  }

  protected function conditionFieldStruct($field, $option, $value) {
    if($c = $this->_conditionFieldStruct($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldStruct($field, $option, $value)) return $c;
  }

  protected function conditionFieldAux($field, $option, $value) {
    if($c = $this->_conditionFieldAux($field, $option, $value)) return $c;
    if($c = EntitySql::getInstanceRequire('domicilio','dom')->_conditionFieldAux($field, $option, $value)) return $c;
  }


  public function format(array $row){
    $row_ = array();
    if(array_key_exists('id', $row))  $row_['id'] = $this->format->string($row['id']);
    if(array_key_exists('nombres', $row)) $row_['nombres'] = $this->format->string($row['nombres']);
    if(array_key_exists('apellidos', $row)) $row_['apellidos'] = $this->format->string($row['apellidos']);
    if(array_key_exists('fecha_nacimiento', $row)) $row_['fecha_nacimiento'] = $this->format->date($row['fecha_nacimiento']);
    if(array_key_exists('numero_documento', $row)) $row_['numero_documento'] = $this->format->string($row['numero_documento']);
    if(array_key_exists('cuil', $row)) $row_['cuil'] = $this->format->string($row['cuil']);
    if(array_key_exists('genero', $row)) $row_['genero'] = $this->format->string($row['genero']);
    if(array_key_exists('apodo', $row)) $row_['apodo'] = $this->format->string($row['apodo']);
    if(array_key_exists('telefono', $row)) $row_['telefono'] = $this->format->string($row['telefono']);
    if(array_key_exists('email', $row)) $row_['email'] = $this->format->string($row['email']);
    if(array_key_exists('alta', $row)) $row_['alta'] = $this->format->timestamp($row['alta']);
    if(array_key_exists('domicilio', $row)) $row_['domicilio'] = $this->format->string($row['domicilio']);

    return $row_;
  }


}
