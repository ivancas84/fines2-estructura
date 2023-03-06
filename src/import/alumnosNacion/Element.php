<?php

require_once("import/Element.php");

class AlumnosNacionImportElement extends ImportElement {

  public $institucion = null;
  public function setEntities($row) { //@override
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "alumno","?"); //se define una instancia vacia de alumno
    $this->setEntity($row, "alumno_comision","?"); //se define una instancia vacia de alumno comision
    
    $this->institucion = $row["no_escuela_fines_institucion"];
    $this->entities["alumno"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
  }

  public function compare(string $name, $existent, $updateNull = false){
    /**
     * @param $name Identificador de la entidad
     */

    if(($name == "persona")  && (!$this->entities["persona"]->checkNombresParecidos($existent)))
      throw new Exception("En la base existe una persona cuyos datos no coinciden");

    return parent::compare($name, $existent, $updateNull);
  }


  public function update($compare, $entity_name, $existente, $name, $updateNullExistent = null){
    if(empty($compare)) return true;

    if($name == "persona") {
      $updateMode = true;
      if(in_array("fecha_nacimiento", $compare) && !Validation::is_empty($existente->_get("fecha_nacimiento"))) $updateMode = false;
      if($updateMode && in_array("telefono", $compare) && !Validation::is_empty($existente->_get("telefono"))) $updateMode = false;
      if(!$updateMode) throw new Exception("El registro debe ser actualizado, comparar");
    } 
    
    $this->logs->addLog($name,"info","Registro existente, se actualizara campos");
    $this->sql .= $this->container->getEntitySqlo($entity_name)->update($this->entities[$name]->_toArray("sql"));
    return true;
  }
 

  
}