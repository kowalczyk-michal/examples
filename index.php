<?php
/*
* SALARY DATE GENERATOR
*
* INFORMATION IN READ.ME
* THIS REPOSITORY IS A SAMPLE OF MY CODE
*
*@michal_kowalczyk
*/

require_once('controller/Controller.php'); //load necessery controller
require_once('controller/SalaryController.php'); //load our salary application controller

//run application
$salaryController = new SalaryController($argv);
$salaryController->run();