<?php

require_once("import/Element.php");
require_once("function/nombres_parecidos.php");

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

  public function compare($name, $includeNull = false, $ignoreFields = []){
    /**
     * @param $name Identificador de la entidad
     */

    if($name == "persona"){  
      $existent = $this->getExistent($name);
      if (!nombres_parecidos($this->entities["persona"]->_get("nombre"), $existent->_get("nombre"), 5)) throw new Exception("En la base existe una persona cuyos datos no coinciden: EXISTENTE " . $existent->_get("nombre") . " NUEVO ". $this->entities["persona"]->_get("nombre"));      
      return parent::compare($name, $includeNull,["nombres","apellidos"]);

    }
    return parent::compare($name, $includeNull);
        
  }

 

  
}