<?php

require_once("../config/config.php");
require_once("Container.php");

$container = new Container();



 $r =  $container->query("calificacion")->fields()
    ->size(0)->cond([
      ["alumno","=",['607d89d078f89','607d89d079b46']],
      [
        ["nota_final",">=","7"],
        ["crec",">=","4","OR"]
      ]
    ])->order([])->sql();
    // ->order(["planificacion_dis-anio"=>"ASC", "planificacion_dis-semestre"=>"ASC"])->sql();
    
    echo "<pre>";
    print_r($r);
   
   