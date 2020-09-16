<?php

require_once("class/model/Sql.php");

class CalendarioSql extends EntitySql {

  public function _mappingField($field){
    $p = $this->prf();
    $t = $this->prt();

    switch ($field) {
      case $p.'_label': return "CONCAT(
  {$t}.anio,'-',{$t}.semestre,
  IF({$t}.inicio,CONCAT(' ', {$t}.inicio),''),
  IF({$t}.fin,CONCAT(' ', {$t}.fin),'')
)";
      default: return parent::_mappingField($field);
    }
  }
}
