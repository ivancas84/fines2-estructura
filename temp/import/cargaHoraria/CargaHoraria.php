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
        $this->queryEntity_("asignatura","nombre");
        $this->queryEntity_("clasificacion","nombre");
        $this->queryEntityIdentifier_("plan");
        $this->queryEntityIdentifier_("carga_horaria");
    }

    public function process(){
        foreach($this->elements as &$element) {
            if(!$element->process) continue;
            $element->sql .= $this->processSource_("asignatura", $element->entities, $element->entities["asignatura"]->nombre());
            $element->sql .= $this->processSource_("clasificacion", $element->entities, $element->entities["clasificacion"]->nombre());
            $element->sql .= $this->processSource_("plan", $element->entities, $element->entities["plan"]->_identifier());
            
            $element->entities["carga_horaria"]->setAsignatura($element->entities["asignatura"]->id);
            $element->entities["carga_horaria"]->setPlan($element->entities["plan"]->id);
            $element->sql .= $this->processSource_("carga_horaria", $element->entities, $element->entities["carga_horaria"]->_identifier());

        }
    }

}