<?php

require_once("import/Import.php");
require_once("model/Db.php");
require_once("tools/Validation.php");
require_once("function/array_group_value.php");
require_once("function/settypebool.php");

class CalificacionImport extends Import{
  /**
   * Importar Calificaciones
   */
  public $idCurso;
  public $curso; //curso
  public $dni_; //dnis de alumnos existentes en el curso
  public $alumno_; //datos de alumnos existentes en el curso
  public $cantidadEvaluados = 0;
  public $cantidadAprobados = 0;
  public $cantidadDesaprobados = 0;
  public $fecha = null;

  public function config(){
    if(Validation::is_empty($this->idCurso)) throw new Exception("El id del curso no se encuentra definido");

    $this->curso = $this->container->query("curso")->fieldsTree()->param("id", $this->idCurso)->one();
    if(empty($this->curso)) throw new Exception("El curso no existe");

    $this->dni_();
    $this->container->entity("persona")->identifier = ["numero_documento"];
    $this->container->entity("alumno")->identifier = ["persona-numero_documento"];
    $this->container->entity("calificacion")->identifier = ["persona-numero_documento", "disposicion-planificacion", "disposicion-asignatura"];
    $this->container->entity("disposicion")->identifier = ["planificacion", "asignatura"];
  }


  public function dni_(){
    $alumnoComision = $this->container->query("alumno_comision")
    ->cond(["comision","=",$this->curso["comision"]])
    ->fields()
    ->all();
    $this->dni_ = array_column($alumnoComision,"persona_numero_documento");
    $this->alumno_ = array_group_value($alumnoComision, "persona_numero_documento");
  }

  public function identify(){
    foreach($this->elements as &$element){
      if(!$element->process) continue;
      try{
        $element->identifyCheck("alumno");
        $element->identifyCheck("calificacion");
        $element->identifyCheck("persona");
        $element->identify("disposicion");

      } catch(Exception $exception){
        $element->process = false;
        $element->logs->addLog("identify","error",$exception->getMessage());
      }
    }
  }

  public function query(){

    $this->queryEntity("persona");
    $this->queryEntity("disposicion");
    $this->queryEntity("calificacion");
    $this->queryEntity("alumno");
  }

  public function process(){    
    foreach($this->elements as &$element) {
      if(!$element->process) continue;
      try{
        $idPersona = $this->existsPersona($element);
        $idDisposicion = $element->exists("disposicion");
        $idAlumno = $element->exists("alumno");

        $element->entities["calificacion"]->_set("disposicion", $idDisposicion);
        $element->entities["calificacion"]->_set("alumno", $idAlumno);
  
        $existente = $element->getExistent("calificacion");
        if($existente){
          $compare = $element->compare("calificacion");
          if(
            (in_array("crec", $compare) && !Validation::is_empty($existente->_get("crec"))) 
            || (in_array("nota_final", $compare) && !Validation::is_empty($existente->_get("nota_final")))
          ) {
            throw new Exception("Calificacion diferente, no se actualizara ningun valor");
          }

          $element->update("calificacion");
        } else {        
          $element->insert("calificacion");
        }
    
        if(Validation::is_empty($element->entities["calificacion"]->_get("crec"))
          && Validation::is_empty($element->entities["calificacion"]->_get("nota_final")))
            throw new Exception("calificacion vacia, no se actualizara ningun valor");
  

      } catch(Exception $exception){
        $element->process = false;
        $element->logs->addLog("process", "error", $exception->getMessage());
      }

    }
  }


  
  public function existsPersona(&$element){
    $personaExistente = $element->getExistent("persona");
    if(!$personaExistente) throw new Exception("Los datos de la persona no existen en la base de datos");
    
    if(!$element->entities["persona"]->checkNombresParecidos($personaExistente)) throw new Exception("En la base existe una persona cuyos datos no coinciden");

    if(!in_array($element->entities["persona"]->_get("numero_documento"), $this->dni_)) throw new Exception("La persona no existe en la comisión");
    
    $pos = array_search($element->entities["persona"]->_get("numero_documento"), $this->dni_);
    unset($this->dni_[$pos]);
  }




  public function summary() {
    parent::summary();
    if(count($this->dni_)) {
      echo "<p>Los siguientes alumnos activos no fueron evaluados:<p>";

      foreach($this->dni_ as $dni) {
        $activo = settypebool($this->alumno_[$dni][0]["activo"]);
        if($activo) echo  $dni . " " . $this->alumno_[$dni][0]["persona_apellidos"] . " " . $this->alumno_[$dni][0]["persona_nombres"]. "<br/>";
      }
    }
}












}