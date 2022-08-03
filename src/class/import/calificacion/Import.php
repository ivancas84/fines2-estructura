<?php

require_once("class/import/Import.php");
require_once("class/model/Db.php");
require_once("class/tools/Validation.php");
require_once("function/array_group_value.php");

class CalificacionImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $mode = "tab";
  public $idCurso;
  public $curso; //curso
  public $dni_; //dnis de alumnos existentes en el curso
  public $alumno_; //datos de alumnos existentes en el curso
  public $id = "calificacion"; //identificacion de la importacion (para facilitara la instanciacion de la clase Element)
  public $cantidadEvaluados = 0;
  public $cantidadAprobados = 0;
  public $cantidadDesaprobados = 0;
  public $fecha = null;

  public function main(){
    if(Validation::is_empty($this->idCurso)) throw new Exception("El id del curso no se encuentra definido");

    $this->curso = $this->container->getDb()->get("curso", $this->idCurso);
    if(empty($this->curso)) throw new Exception("El curso no existe");

    $this->dni_();

    $this->container->getEntity("alumno")->identifier = ["per-numero_documento"];
    $this->container->getEntity("calificacion")->identifier = ["alu_per-numero_documento", "dis-planificacion", "dis-asignatura"];
    $this->container->getEntity("disposicion")->identifier = ["planificacion", "asignatura"];
    parent::main();
    // $this->define();
    // $this->identify();
    // $this->query();
    // $this->process();
    // $this->persist();
  }

  public function dni_(){
    $render = $this->container->getRender("alumno_comision");
    $render->setCondition(["comision","=",$this->curso["comision"]]);
    $alumnoComision = $this->container->getDb()->all("alumno_comision",$render);
    $this->dni_ = array_column($alumnoComision,"alu_per_numero_documento");
    $this->alumno_ = array_group_value($alumnoComision, "alu_per_numero_documento");
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

    if(!in_array($dni, $this->dni_)) {
      $element->logs->addLog("persona", "error", "La persona no existe en la comision");
      $element->process = false;
      return false;
    } else {
      $pos = array_search($dni, $this->dni_);
      unset($this->dni_[$pos]);
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

    try {

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
        if(!empty($compare))  throw new Exception("El registro debe ser actualizado, comparar");
      } else {        
        $element->insert("calificacion");
      }
  
      return $value;
    } catch (Exception $e) {
      $element->process = false;
      $element->logs->addLog($name,"error",$e->getMessage());
      return false;
    }



  }


  public function summary() {
    parent::summary();
    if(count($this->dni_)) {
      echo "<p>Los siguientes alumnos no fueron evaluados:<p>";
      foreach($this->dni_ as $dni) echo  $dni . " " . $this->alumno_[$dni][0]["alu_per_apellidos"] . " " . $this->alumno_[$dni][0]["alu_per_nombres"]. "<br/>";
    }
}












}