<?php

require_once("../config/config.php");

require_once("class/controller/Admin.php");

EntityAdminController::getInstanceRequire("comision")->persistRow(["test"=>2]);