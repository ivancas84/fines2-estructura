<?php

require_once("../config/config.php");

require_once("class/controller/Admin.php");

echo EntitySqlo::getInstanceRequire("asignatura")->all();
