<?php
session_start();
spl_autoload_register(function($class) {
  $classUrl = $_SERVER['DOCUMENT_ROOT'].'/class/' . $class . '.php';
  if(!file_exists($_SERVER['DOCUMENT_ROOT'].'/class/' . $class . '.php')){
    throw new Exception('File '.$classUrl.' does not exist !');
    exit();
  }
    require_once $classUrl;
});
?>