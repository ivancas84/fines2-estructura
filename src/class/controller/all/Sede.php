<?php

require_once("class/controller/All.php");

class SedeAll extends All {
  public $entityName = "sede";
  
  protected function renderComisionCondition($key){
    if($this->display["params"][$key]) {
      unset($this->display["params"][$key]);
      $this->renderComision->addCondition($key, "=", $this->display["params"][$key]);
    }
  }

  public function main($display) {
    $this->display = $display;
    if(array_key_exists ("params" , $this->display)  && 
      (array_key_exists ("modalidad" , $this->display["params"]) 
      || array_key_exists ("fecha_anio" , $this->display["params"]) 
      || array_key_exists ("fecha_semestre" , $this->display["params"])
    )) {
      $this->renderComision = new Render();
      $this->renderComisionCondition("modalidad");
      $this->renderComisionCondition("fecha_anio");
      $this->renderComisionCondition("fecha_semestre");

      $comisiones = Ma::all("comision", $render);
      $sedes = array_unique_key($comisiones, "sede");
    }

    $render = Render::getInstanceDisplay($display);
    if(isset($sedes))  $render->addCondition("id","=",$sedes);
    
    return $render;
  }

}

