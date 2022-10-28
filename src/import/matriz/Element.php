<?php

require_once("import/Element.php");

class MatrizImportElement extends ImportElement {

  public $numeroSede;
  public $division;
  public $updateMode = false;

  public function setEntities($row) { //@override
    //Si la nota final tiene una C, debe ser considerado como crec
    if(
      strpos(
        strtolower($row["nota_final"]),
        "c"
      ) !== false
    ) {
      $row["crec"] = preg_replace("/[^0-9]/", "", $row["nota_final"]);
      $row["nota_final"] = null;
    } else {
      if(!empty($row["nota_final"])) $row["nota_final"] = preg_replace("/[^0-9]/", "", $row["nota_final"]);
      if(!empty($row["crec"])) $row["crec"] = preg_replace("/[^0-9]/", "", $row["crec"]);
    }
    
    $row["per_numero_documento"] = preg_replace("/[^0-9\_]/", "", $row["per_numero_documento"]);
    //se permiten numeros y guiones bajos para identificar el dni
    
     
    $this->setCurso($row);
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "calificacion");

  }

  public function setCurso($row){
    $this->entities["curso"] = $this->container->value("curso");
    $this->entities["curso"]->_set("identifier", 
      $this->numeroSede . UNDEFINED .
      $this->division . UNDEFINED .
      $row["com_pla_anio"] . UNDEFINED .
      $row["com_pla_semestre"]. UNDEFINED .
      $row["asi_codigo"]
    );
  }
  
  
}