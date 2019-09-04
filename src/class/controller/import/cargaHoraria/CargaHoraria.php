<?php

require_once("class/import/Import.php");
require_once("class/controller/import/cargaHoraria/CargaHorariaElement.php");

class CargaHorariaImport extends Import {

    public function element($i, $data){
        $element = new CargaHorariaImportElement($i, $data); 
        array_push($this->elements, $element);
    }

    public function identify(){
        foreach($this->elements as &$element){

            $this->identifyValue_("asignatura", $element->entities["asignatura"]->nombre());
            $this->identifyValue_("clasificacion", $element->entities["clasificacion"]->nombre());

            $element->entities["plan"]->_setIdentifier(
                $element->entities["plan"]->orientacion().UNDEFINED.
                $element->entities["plan"]->resolucion()
            );
            $this->identifyValue_("plan", $element->entities["plan"]->_identifier());

            $element->entities["carga_horaria"]->_setIdentifier(
                $element->entities["asignatura"]->nombre().UNDEFINED.
                $element->entities["plan"]->_identifier().UNDEFINED.
                $element->entities["carga_horaria"]->anio().UNDEFINED.
                $element->entities["carga_horaria"]->semestre()
            );        
            $this->identifyValue_("carga_horaria", $element->entities["carga_horaria"]->_identifier());    
        }
    }


    public function query(){
        $this->queryEntityField_("asignatura","nombre");
        $this->queryEntityField_("clasificacion","nombre");
        $this->queryEntityIdentifier_("plan");
        $this->queryEntityIdentifier_("carga_horaria");
    }

    public function process(){
        foreach($this->elements as &$element) {
            if(!$element->process) continue;
            $this->processSource_("asignatura", $element->entities["asignatura"], $element->entities["asignatura"]->nombre());
            $this->processSource_("clasificacion", $element->entities["clasificacion"], $element->entities["clasificacion"]->nombre());
            $this->processSource_("plan", $element->entities["asignatura"], $element->entities["plan"]->_identifier());
            $this->processSource_("carga_horaria", $element->entities["carga_horaria"], $element->entities["carga_horaria"]->_identifier());
        }
    }

}