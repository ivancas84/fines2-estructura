<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");

class CalificacionImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $mode = "tab";
  public $idCurso;
  public $curso;
  public $id = "calificacion";

  public function main(){
    if(Validation::is_empty($this->idCurso)) throw new Exception("El id del curso no se encuentra definido");

    $this->curso = $this->container->getDb()->get("curso", $this->idCurso);
    if(empty($this->curso)) throw new Exception("El curso no existe");

    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    $this->container->getEntity("calificacion")->identifier = ["alu_per-numero_documento", "dis-planificacion", "dis-asignatura"];
    $this->container->getEntity("disposicion")->identifier = ["planificacion", "asignatura"];
    //parent::main();
    $this->define();
    $this->identify();
    $this->query();
    $this->process();
    // // $this->persist();
  }

  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["disposicion"] = [];
    $this->ids["calificacion"] = [];
    $this->ids["alumno"] = [];
    
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      if(!($idDisposicion = $element->getIdentifier("disposicion", "identifier"))) continue;
      if(!($idCalificacion = $element->getIdentifier("calificacion", "identifier"))) continue;
      if(!($idAlumno = $element->getIdentifier("alumno", "identifier"))) continue;

      
      if(!$this->idEntityFieldCheck("alumno", $idAlumno, $element)) continue;
      if(!$this->idEntityFieldCheck("calificacion", $idCalificacion, $element)) continue;
      if(!$this->idEntityFieldCheck("persona", $dni, $element)) continue;
      if(!$this->idEntityField("disposicion", $idDisposicion, $element)) continue;
      
    }
  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("disposicion","identifier");
    $this->queryEntityField("calificacion","identifier");
    $this->queryEntityField("alumno","identifier");

  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
     
      if(!$this->existsPersona($element)) continue;
      if(!$this->existElement($element, "disposicion", "identifier")) continue;
      if(!$this->existElement($element, "alumno", "identifier")) continue;


      $idCalificacion = $this->processCalificacion($element);
      if($idCalificacion === false) continue;
    }
  }


  
  public function existsPersona(&$element){
    if(!$this->existElement($element, "persona", "numero_documento")) return false;
      $dni = $element->entities["persona"]->_get("numero_documento");
 
    /**
     * Variante del insertElement para verificar los nomrbes de la persona
     */
     
    $personaExistente = $this->container->getValue("persona");
    $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
    if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
      $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
      $element->process = false;
      return false;
    } 

    return $dni;
  }



  public function processCalificacion(&$element){
    $element->entities["calificacion"]->_set("disposicion",
      $element->entities["disposicion"]->_get("id")
    );
    $element->entities["calificacion"]->_set("alumno",
      $element->entities["alumno"]->_get("id")
    );

    $idCalificacion = $this->processCalificacionElement($element);

    if(Validation::is_empty($element->entities["calificacion"]->_get("crec"))
      && Validation::is_empty($element->entities["calificacion"]->_get("nota_final"))) {
        $element->process = false;
        $element->logs->addLog("calificacion", "info", "Calificacion vacia, no se actualizara ningun valor");
        return false;                
    }
    return $idCalificacion;
  }

  public function processCalificacionElement(&$element){
    $value = $element->entities["calificacion"]->_get("identifier");
    if(key_exists($value, $this->dbs["calificacion"])) {
      $existente = $this->container->getValue("calificacion");
      $existente->_fromArray($this->dbs["calificacion"][$value], "set");
      $element->entities["calificacion"]->_set("id",$existente->_get("id"));
      $compare = $element->compare("calificacion", $existente);  
      
      if(
        (in_array("crec", $compare) && !Validation::is_empty($existente->_get("crec"))) 
        || (in_array("nota_final", $compare) && !Validation::is_empty($existente->_get("nota_final")))
      ) {
        $element->logs->addLog("calificacion", "error", "Calificacion diferente, no se actualizara ningun valor");
        $element->process = false;
        return false;
      }
      if($compare) {
        if(!$element->update("calificacion", $existente)) return false;
      }
    } else {        
      if(!$element->insert("calificacion")) return false;
    }

    return $value;
  }

  












}