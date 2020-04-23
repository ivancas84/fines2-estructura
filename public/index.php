<?php

//require_once("../config/config.php");
session_start();
//session_id(1); //comentar en produccion

$param = explode('/', trim($_SERVER['REDIRECT_URL'], '/')); //en cliente
//$param = explode('/', trim($_SERVER['REQUEST_URI'], '/')); //en produccion

$index = array_search("public", $param);
$options = array_slice($param, -2);
define("ENTITY", $options[0]);
$interface = $options[1];
$inc = require("public/" . $interface . "/index.php");
//if(!$inc) print_r($_REQUEST);
