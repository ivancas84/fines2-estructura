<?php

require_once("class/import/Element.php");
require_once("class/tools/Validation.php");


class ControlDuplicadosImportElement extends ImportElement {

  public function setEntities($row) { //@override
    $row["nombres"] = $row["numero_documento"];
    if(preg_match("/[a-z]/i", $row["numero_documento"])){
      $this->logs->addLog("persona", "warning", "El número de documento tiene letras, se ignoraran y se consideraran solo los numeros");
    }


    $row["numero_documento"] = preg_replace("/[^0-9]/", "", $row["numero_documento"] );

    if(strlen($row["numero_documento"]) > 8 || strlen($row["numero_documento"]) < 7) {
      if(strlen($row["numero_documento"]) == 11) {
        $this->logs->addLog("persona", "warning", "El número de documento tiene una longitud de 11 caracteres, se considerara como CUIL y se obtendra el DNI");
        $row["numero_documento"] = substr($row["numero_documento"],2,8);
      } else {
        $this->logs->addLog("persona", "warning", "El número de documento tiene una longitud de " . strlen($row["numero_documento"]) . " caracteres, REVISAR");
      }
    }

    if(Validation::is_empty($row["numero_documento"])){
      $this->process = false;                
      $this->logs->addLog("persona", "error", "El número de documento no se encuentra definido");

    }

    if($row["nombres"] == $row["numero_documento"]) $row["nombres"] = null;
    $this->setEntity($row, "persona");
  }
  
}