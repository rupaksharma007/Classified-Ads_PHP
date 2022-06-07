<?php
require_once('_config.php');
require_once('_router.php');
$url = rtrim($_SERVER['REQUEST_URI'], '/');
$url = ltrim($_SERVER['REQUEST_URI'], '/');
$url = explode('?',$url);
$param=null;
if(empty($url[0]))
	$index = '';
else{
	$index = rtrim($url[0], '/');
	if(strpos($index, '/')!==false){
		list($index, $param) = explode('/',$index,2);
	}
}

//Check if application installed
if($index!='install' && !file_exists('class/init.php'))
header("location: /install");

if(array_key_exists($index, $ROUTE)){
	if(!empty($ROUTE[$index][1])){
		$ob = (empty($param))? new $ROUTE[$index][1] : new $ROUTE[$index][1]($param);
	}
	else
		$ob = new Core();
	include('views/'.$ROUTE[$index][0]);
}
else
{
	echo '<br><br><br><center><h1> ERROR 404 ! URL not found ! </h1><center>';
}

//#pv7r5

?>