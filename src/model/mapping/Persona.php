<?php
require_once("model/entityOptions/Mapping.php");

class PersonaMapping extends MappingEntityOptions{

  public function primerNombreApellido() {
    return "CONCAT_WS(' ', SUBSTRING_INDEX( {$this->_pt()}.nombres , ' ', 1 ), SUBSTRING_INDEX( {$this->_pt()}.apellidos , ' ', 1 )      
    )";
  }

  public function primerApellidoNombre() {
    return "CONCAT_WS(' ', SUBSTRING_INDEX( {$this->_pt()}.apellidos , ' ', 1 ), SUBSTRING_INDEX( {$this->_pt()}.nombres , ' ', 1 )      
    )";
  }


}
