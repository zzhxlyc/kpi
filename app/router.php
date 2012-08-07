<?php
/*
 * $router->add('/home', array('C'=>'UserController', 
 * 								'M'=>'index',
 * 								'module'=>'folder_name',
 * 								'prefix'=>'/'));
 */
$router->add('/', array('C'=>'LoginController', 'M'=>'login'));
$router->add('/login', array('C'=>'LoginController', 'M'=>'login'));
$router->add('/loginout', array('C'=>'LoginController', 'M'=>'loginout'));

