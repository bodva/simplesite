<?php
session_name('simplesite');
session_start();
define('defSimpleSite', md5('hello word'));

class kconfig{
	/*static $dbtype = 'pgsql';
	static $dbuser = 'postgres';
	static $dbpaswd = 'astalavista';*/
	static $dbtype = 'mysql';
	static $dbuser = 'root';
	static $dbpaswd = '';
	static $dbserver = 'localhost';
	static $dbbase = 'simplesite';
	
	static $usedebug = false;

	static $author = "BoDVa";
}

include './core/base.php';
?>