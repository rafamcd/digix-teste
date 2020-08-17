<?php
require 'environment.php';

global $config;
global $db;

$config = array();
if(ENVIRONMENT == 'development') {
	define("BASE_URL", "http://inteco.pc/novo/");
	$config['dbname'] = 'digix';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'root';
	$config['dbpass'] = '';
} else {
	define("BASE_URL", "http://www.inteco.com.br/novo/");
	$config['dbname'] = 'intecoc_digix';
	$config['host'] = 'localhost';
	$config['dbuser'] = 'intecoc_teste';
	$config['dbpass'] = 'testedigix123.';
}

$db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);