<?php
//add ROUTES in array in order 'URL' => array('VIEW FILE NAME','CLASS NAME');
$ROUTE = array(
	'install' => array('install.php','Install'),
	'' => array('home.php','Home'),
	'register' => array('register.php','Home'),
	'login' => array('login.php','Home'),
	'view' => array('open.php','View'),
	'list' => array('list.php','Lists'),
	'all-ads' => array('list.php','Lists'),
	'search' => array('list.php','Lists'),
	'dashboard' => array('dashboard.php','Dashboard')
);
?>