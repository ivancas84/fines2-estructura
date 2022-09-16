<?php

require_once("class/import/Element.php");

class AlumnosComisionImportElement extends ImportElement {


  public function setEntities($row) { //@override
    $row["per_numero_documento"] = preg_replace("/[^0-9\_]/", "", $row["per_numero_documento"]);
    //se permiten numeros y guiones bajos para identificar el dni

    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "alumno");
    $this->setEntity($row, "alumno_comision","?"); //se define una instancia vacia de alumno comision
    
    $this->entities["persona"]->_set("identifier", $this->entities["persona"]->_get("numero_documento"));
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

  public function compare($name, $includeNull = false){
    /**
     * @param $name Identificador de la entidad
     */

    if($name == "persona"){  
      $existent = $this->getExistentValue($name);
      if (!$this->entities["persona"]->checkNombresParecidos($existent)) throw new Exception("En la base existe una persona cuyos datos no coinciden");
    }
        
    return parent::compare($name, $includeNull);
  }

 

  
}