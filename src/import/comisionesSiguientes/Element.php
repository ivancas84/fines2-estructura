<?php

require_once("import/Element.php");

class ComisionesSiguientesImportElement extends ImportElement {

  
  public function setEntities($row) { //@override

    $this->setEntity($row, "comision");
    $this->entities["comision"]->_fastSet("id",null);
    $this->entities["comision"]->_fastSet("apertura",false);
    $this->entities["comision"]->_fastSet("alta",new DateTime());
    $this->entities["comision"]->_fastSet("calendario",$this->import->idCalendario);
    $this->entities["comision"]->_fastSet(
      "planificacion",
      $this->entities["comision"]->planificacionSiguiente()
    );
    $this->entities["comision"]->_fastSet(
      "identifier", 
      $row["sed_numero"].UNDEFINED.
      $row["division"].UNDEFINED.
      $this->entities["comision"]->_get("planificacion")
    );

    if(Validation::is_empty($this->entities["comision"]->_get("planificacion"))) {
      $this->process = false;
      $this->logs->addLog("comision", "error", "Planificacion vacia");                
    }

    $this->setEntity($row, "comision", "", "comision_anterior");
    $this->entities["comision_anterior"]->_fastSet("identifier", $row["sed_numero"].UNDEFINED.$row["division"].UNDEFINED.$row["planificacion"]);

  }
  
 
  public function compareUpdate($entityName, $id, $name = null){
    /**
     * Realiza la comparacion y actualiza
     * 
     * Este metodo se define de forma independiente para facilitar su reimplementacion
     * @param $id Valor del identificador
     * @param $updateMode: Modo de actualizacion 
     *   true actualiza
     *   false error log indicando que debe actualizarse)
     * @param $name Nombre alternativo de la entityName que es utilizado para identificar la entidad
     */

    if($name == "comision_anterior") {
      $existente = $this->container->value($entityName);
      $existente->_fromArray($this->import->dbs[$name][$id], "set");
      $this->entities[$name]->_set("id",$existente->_get("id"));
      $compare = $this->compare($name, $existente);  
      return $this->update($compare, $entityName, $existente, $name, true);
    } 

    return parent::compareUpdate($entityName, $id, $name);
    
  }
}