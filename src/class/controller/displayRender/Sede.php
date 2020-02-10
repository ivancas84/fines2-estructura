<?php

require_once("class/controller/DisplayRender.php");
require_once("function/array_unique_key.php");

class SedeDisplayRender extends DisplayRender {
  public $entityName = "sede";

  protected function renderComisionCondition($key){
    if(array_key_exists ($key , $this->display["params"])
    && (!empty($this->display["params"][$key]))) {
        $this->renderComision->addCondition($key, "=", $this->display["params"][$key]);
        $this->paramsComision = true;
    }
  }
  
  public function main($display) {
    $this->display = $display;
    $this->paramsComision = false;
    if(array_key_exists ("params" , $this->display)){
      $this->renderComision = new Render();
      foreach($this->display["params"] as $key => $value){
        switch($key) {
          case "centro_educativo":
            /** 
             * parametros de sede 
             */
            continue;
          break;
          case "modalidad":
            /**
             * parametros de comision
             */
            $this->renderComisionCondition($key);
            unset($this->display["params"][$key]);
          break;
          
          default:
            /**
             * parametros no validos
             */
            unset($this->display["params"][$key]);
        }
      }
      if($this->paramsComision){
        $comisiones = Ma::all("comision", $this->renderComision);
        $sedes = array_unique_key($comisiones, "sede");
      }
    }

    $render = RenderPlus::getInstanceDisplay($this->display);
    if(isset($sedes)) $render->addCondition("id","=",$sedes);

    return $render;
  }

}

