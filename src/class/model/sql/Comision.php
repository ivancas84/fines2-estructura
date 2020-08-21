<?php

require_once("class/model/sql/_Comision.php");

class ComisionSql extends _ComisionSql {

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'tramo': return "CONCAT(COALESCE({$p}pla.anio,''), COALESCE({$p}pla.semestre,''))";
      case $p.'_label': return "CONCAT(
  {$p}sed.numero, {$t}.division,
  IF({$p}pla.id, CONCAT({$p}pla.anio,{$p}pla.semestre), ''),
  IF({$p}cal.id, CONCAT(' ',{$p}cal.anio,'-',{$p}cal.semestre), ''),
  IF({$p}cal.inicio,CONCAT(' ', {$p}cal.inicio),''),
  IF({$p}cal.fin,CONCAT(' ', {$p}cal.fin),'')
)";
      default: return parent::_mappingField($field);
    }
  }

}
