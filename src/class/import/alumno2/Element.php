<?php

require_once("class/import/Element.php");

class Alumno2ImportElement extends ImportElement {

  public function persist(){
    if(empty($this->sql)) {
      $this->logs->addLog("persist","info","No se realizara ningun cambio en la base de datos");
      return;
    }
    try {
      echo "<pre>".$this->sql."</pre>";
    } catch(Exception $exception){
      $this->logs->addLog("persist","error",$exception->getMessage());
    }
  }

  public function setEntities($row) { //@override
    $this->setEntity($row, "persona", "per");
    $this->setEntity($row, "comision", "com");
    $this->entities["comision"]->_set("identifier",$row["com_identifier"]);
    $this->setEntity($row, "alumno");


  }
  
  
}