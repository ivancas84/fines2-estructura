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
    $this->container->getEntity("calificacion")->identifier = ["per-numero_documento", "pla-plan", "pla-anio", "pla-semestre", "asi-codigo"];

    parent::main();
    // $this->define();
    // $this->identify();
    // $this->query();
    // $this->process();
    // $this->persist();
  }
  
  public function identify(){
    $this->ids["persona"] = [];
    $this->ids["calificacion"] = [];
    foreach($this->elements as &$element){
      if(!($dni = $element->getIdentifier("persona", "numero_documento"))) continue;
      
      $idCalificacion = $dni.UNDEFINED.$this->curso["com_pla_plan"].UNDEFINED.$this->curso["com_pla_anio"].UNDEFINED.$this->curso["com_pla_semestre"].UNDEFINED.$this->curso["asi_codigo"];
      $element->entities["calificacion"]->_set("identifier", $idCalificacion);

      if(!$this->idEntityFieldCheck("calificacion", $idCalificacion, $element)) continue;
      if(!$this->idEntityFieldCheck("persona", $dni, $element)) continue;
    }
  }

  public function query(){
    $this->queryEntityField("persona","numero_documento");
    $this->queryEntityField("calificacion","identifier");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
     
      $dni = $this->insertPersona($element);
      if($dni === false) continue;

      
      $idCalificacion = $this->processCalificacion($element);
      if($idCalificacion === false) continue;


      $this->dbs["persona"][$dni] = $element->entities["persona"]->_toArray("get");
      $this->dbs["calificacion"][$idCalificacion] = $element->entities["calificacion"]->_toArray("get");
    }
  }


  
  public function insertPersona(&$element){
    $dni = $element->entities["persona"]->_get("numero_documento");
 
    /**
     * Variante del insertElement para verificar los nomrbes de la persona
     */
     
    if(key_exists($dni, $this->dbs["persona"])){
      $personaExistente = $this->container->getValue("persona");
      $personaExistente->_fromArray($this->dbs["persona"][$dni], "set");
      if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)){
        $element->logs->addLog("persona", "error", "En la base existe una persona cuyos datos no coinciden");
        $element->process = false;
        return false;
      }

      $element->entities["persona"]->_set("id",$personaExistente->_get("id"));
      $element->logs->addLog("persona", "info", "Registro existente, no será actualizado");
    } else {
      $element->insert("persona");
    }

    return $dni;
  }



  public function processCalificacion(&$element){
    $element->entities["calificacion"]->_set("asignatura",
      $this->curso["asignatura"]
    );
    $element->entities["calificacion"]->_set("planificacion",
      $this->curso["com_planificacion"]
    );
    $element->entities["calificacion"]->_set("curso",
      $this->curso["id"]
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