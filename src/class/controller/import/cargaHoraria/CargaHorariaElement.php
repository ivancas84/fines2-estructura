<?php

require_once("class/import/Element.php");

class CargaHorariaImportElement extends ImportElement {
    
    public function setEntities($row) {
        $this->setEntity_("plan", $row, "plan_");
        $this->setEntity_("carga_horaria", $row, "carga_horaria_");
        $this->setEntity_("asignatura", $row, "asignatura_");
        $this->setEntity_("clasificacion", $row, "clasificacion_");
    }
}
