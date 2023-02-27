<?php
require_once("model/entityOptions/Mapping.php");

class PersonaMapping extends MappingEntityOptions{

  public function primer_nombre_apellido() {
    return "CONCAT_WS(' ', SUBSTRING_INDEX( {$this->_pt()}.nombres , ' ', 1 ), SUBSTRING_INDEX( {$this->_pt()}.apellidos , ' ', 1 )      
    )";
  }

  public function primer_apellido_nombre() {
    return "CONCAT_WS(' ', SUBSTRING_INDEX( {$this->_pt()}.apellidos , ' ', 1 ), SUBSTRING_INDEX( {$this->_pt()}.nombres , ' ', 1 )      
    )";
  }


}
