<?php
require_once("class/model/entityOptions/Mapping.php");

class CursoMapping extends MappingEntityOptions{

  public function label() {
    return "CONCAT(
      {$this->_pf()}com_sed.numero, 
      {$this->_pf()}com.division,
      '/',
      IF(
        {$this->_pf()}com_pla.id, 
        CONCAT(
          {$this->_pf()}com_pla.anio,
          {$this->_pf()}com_pla.semestre
        ), 
        ''
      ),
      ' ',
      {$this->_pf()}asi.nombre
    )";
  }


}
