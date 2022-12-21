<?php

function aniosRestantes($aniosCursados){
    if(in_array("Tercero",$aniosCursados)) return [];
    if(in_array("Segundo",$aniosCursados)) return ["Tercero"];
    if(in_array("Primero",$aniosCursados)) return ["Segundo","Tercero"];
    return ["Primero","Segundo","Tercero"];
  }