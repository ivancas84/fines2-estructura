<?php

require_once("class/import/Element.php");

class AlumnosComisionImportElement extends ImportElement {

  public $notCompare = ["persona"=>["nombres","apellidos"]];

  public function setEntities($row) { //@override
    $row["per_numero_documento"] = preg_replace("/[^0-9\_]/", "", $row["per_numero_documento"]);
    //se permiten numeros y guiones bajos para identificar el dni

    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "alumno");
    $this->setEntity($row, "alumno_comision","?"); //se define una instancia vacia de alumno comision
    
    $this->entities["alumno"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
    $this->entities["alumno_comision"]->_set("comision", 
      $this->import->idComision
    );
    $this->entities["alumno_comision"]->_set("activo", 
      true
    );
    $this->entities["alumno_comision"]->_set("identifier", 
      $this->entities["persona"]->_get("numero_documento") . UNDEFINED .
      $this->import->idComision
    );

  }

  public function compare(string $name, $existent, $updateNull = false){
    /**
     * @param $name Identificador de la entidad
     */

    if(($name == "persona")  && (!$this->entities["persona"]->checkNombresParecidos($existent)))
      throw new Exception("En la base existe una persona cuyos datos no coinciden");

    return parent::compare($name, $existent, $updateNull);
  }


  public function update($compare, $entityName, $existente, $name){
    if(empty($compare)) return true;

    if($name == "persona") {
      $updateMode = true;
      if(in_array("fecha_nacimiento", $compare) && !Validation::is_empty($existente->_get("fecha_nacimiento"))) $updateMode = false;
      if($updateMode && in_array("telefono", $compare) && !Validation::is_empty($existente->_get("telefono"))) $updateMode = false;
      if(!$updateMode) throw new Exception("El registro debe ser actualizado, comparar");
    } 
    
    $this->logs->addLog($name,"info","Registro existente, se actualizara campos");
    $this->sql .= $this->container->getSqlo($entityName)->update($this->entities[$name]->_toArray("sql"));
    return true;
  }
 

  
}