<?php
//Require configs
require_once "config/config.php";
//Require app function 
require_once "helpers/functions.php";
//Auto-load libraries
spl_autoload_register(function($className){
    require_once 'libraries/' . ucwords($className) . '.php';
});