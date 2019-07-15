<?php

require_once("class/model/sql/sede/Main.php");

class SedeSql extends SedeSqlMain {

  public function _subSql(Render $render){
    $t = $this->prt();

    return "SELECT * FROM (
    
SELECT DISTINCT {$this->_fieldsDb()}, coordinador.persona AS coordinador, referente.persona AS referente
{$this->_from($render)}
LEFT OUTER JOIN (
  SELECT MIN(coordinador.persona) AS persona, coordinador.sede
  FROM coordinador
  WHERE baja IS NULL
  GROUP BY coordinador.sede
) AS coordinador ON (coordinador.sede = {$t}.id)
LEFT OUTER JOIN (
  SELECT MIN(referente.persona) AS persona, referente.sede
  FROM referente
  WHERE referente.baja IS NULL
  GROUP BY referente.sede
) AS referente ON (referente.sede = {$t}.id)

) AS {$t}
" . concat($this->_condition($render), 'WHERE ') . "
";
  }



  protected function _conditionFieldAuxFiltros($option, array $value){
    $conditions = [];
    if(isset($value["fecha_anio"])) array_push($conditions, "comision.fecha_anio = '" . $value['fecha_anio'] . "'");
    if(isset($value["fecha_semestre"])) array_push($conditions, "comision.fecha_semestre = " . $value['fecha_semestre']);
    if(isset($value["clasificacion_nombre"])) array_push($conditions, "clasificacion.nombre = '" . $value['clasificacion_nombre'] . "'");
    if(isset($value["clasificacion"])) array_push($conditions, "clasificacion.id = " . $value['clasificacion']);
    if(isset($value["apertura"])){
      if(settypebool($value["apertura"])) array_push($conditions, "comision.apertura");
      else array_push($conditions, "NOT comision.apertura");
    } 
    if(isset($value["autorizada"])){
      if(settypebool($value["autorizada"])) array_push($conditions, "comision.autorizada");
      else array_push($conditions, "NOT comision.autorizada");
    } 

    $condition = implode(" AND ", $conditions);

    $p = $this->prf();
    $opt = ($option == "=") ? "IN" : "NOT IN";
    $id = $this->_mappingField("{$p}id");
    return "{$id} {$opt} (
      SELECT sede.id
      FROM sede
      INNER JOIN division ON (division.sede = sede.id)
      INNER JOIN comision ON (comision.division = division.id)
      INNER JOIN plan ON (division.plan = plan.id)
      INNER JOIN clasificacion_plan ON (plan.id = clasificacion_plan.plan)
      INNER JOIN clasificacion ON (clasificacion_plan.clasificacion = clasificacion.id)
      WHERE {$condition}
    )
    ";

    
  }

  protected function _conditionFieldAuxComision($field, $option, $value){
    /**
     * Metodo utilizado para definir condiciones:
     *    _fecha_anio
     *    _fecha_semestre
     *    _autorizada
     */
    $p = $this->prf();
    $id = $this->_mappingField($p."id");
    $opt = ($option != "=") ? "NOT IN" : "IN";  
    return "{$id} {$opt} (
      SELECT sede.id
      FROM sede
      INNER JOIN division ON (division.sede = sede.id)
      INNER JOIN comision ON (comision.division = division.id)
      WHERE comision.{$field} = '{$value}'
    )
    ";
  }

  protected function _conditionFieldAuxPlan($option, array $planesId){
    /**
     * Metodo utilizado para definir condiciones:
     *    _fecha_anio
     *    _fecha_semestre
     *    _autorizada
     */
    $p = $this->prf();
    $id = $this->_mappingField($p."id");
    $opt = ($option != "=") ? "NOT IN" : "IN";
    $planesId = implode(", ", $planesId);  
    return "{$id} {$opt} (
      SELECT sede.id
      FROM sede
      INNER JOIN division ON (division.sede = sede.id)
      WHERE division.plan IN ({$planesId})
    )
    ";
  }

  public function _conditionFieldAux($field, $option, $value){
    $p = $this->prf();

    switch($field){
      case "{$p}_filtros": return $this->_conditionFieldAuxFiltros($option, $value);
      case "{$p}_fecha_anio": return $this->_conditionFieldAuxComision("fecha_anio", $option, $value);
      case "{$p}_fecha_semestre": return $this->_conditionFieldAuxComision("fecha_semestre", $option, $value);
      case "{$p}_autorizada": return $this->_conditionFieldAuxComision("autorizada", $option, $value);
      case "{$p}_clasificacion":
        $planesIds = Dba::field("clasificacion_plan", "plan", ["clasificacion",$option,$value]);
        return $this->_conditionFieldAuxPlan($option, $planesIds);

      case "{$p}_clasificacion_nombre":
        $planesIds = Dba::field("clasificacion_plan", "plan", ["cla_nombre",$option,$value]);
        return $this->_conditionFieldAuxPlan($option, $planesIds);

      
      default: return parent::_conditionFieldAux($field, $option, $value);
    }

  }




/*
  public function _conditionAux($prefix = ""){
    $p = (empty($prefix)) ?  ''  : $prefix . '_';

    return "{$p}coo_.id IN (
  SELECT id FROM coordinador WHERE baja IS NULL
)";
}*/




}
