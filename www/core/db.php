<?php
if (!defined('defSimpleSite')) {die("Use site core!");}

class kdb{
	private static $dblink;
	private $dbres;
	static function connect(){
		if (kconfig::$dbtype == 'mysql'){
			self::$dblink = mysql_connect(kconfig::$dbserver,kconfig::$dbuser, kconfig::$dbpaswd);
			mysql_select_db(kconfig::$dbbase,self::$dblink);
			mysql_set_charset('utf8',self::$dblink);
			return true;	
		} elseif (kconfig::$dbtype == 'pgsql') {
			$conn_string = "host=".kconfig::$dbserver." port=5432 dbname=".kconfig::$dbbase." user=".kconfig::$dbuser." password=".kconfig::$dbpaswd." options='--client_encoding=UTF8'";
			//$conn_string = "host=localhost port=5432 dbname=kphotomag user=postgres password=astalavista options='--client_encoding=UTF8'";
			self::$dblink = pg_connect($conn_string);
			//print_r(self::$dblink);
		}
	}

	function setpgsintacs($sql){
		return str_replace ('`','"',$sql);	
	}

	function query($sql){
		//echo $sql.'<br>';
		//TODO: help me pls!!
		//TODO: kill me!
		//echo kconfig::$dbtype.'<br>';
		if (kconfig::$dbtype == 'mysql'){
			$this->dbres = mysql_query($sql,self::$dblink);
		} elseif (kconfig::$dbtype == 'pgsql') {
			$sql = $this->setpgsintacs($sql);
			$this->dbres = pg_query(self::$dblink, $sql);
			//$this->dbres = pg_query(self::$dblink, "SELECT * FROM k_users");
		}
		//echo mysql_num_rows($this->dbres);  
		//if (mysql_num_rows($this->dbres)==0) {
		//	return false;
		//} else {
			core::debug ($sql);
			// core::debug ((int)$this->dbres);
			if ($this->dbres == false) return false;
			return true;
		//}
	}

	function read(){
			//echo 'read';
			$arr = array();
			if (kconfig::$dbtype == 'mysql'){
				$arr = mysql_fetch_array($this->dbres);
			} elseif (kconfig::$dbtype == 'pgsql') {
				$arr = pg_fetch_array($this->dbres);
			}
			// core::debug($arr);
			return $arr;
	}
	
	static function disconnect(){
		if (kconfig::$dbtype == 'mysql'){
			mysql_close(self::$dblink);
		} elseif (kconfig::$dbtype == 'pgsql') {
			pg_close(self::$dblink);
		}
		return true;
	}

	function getlastkey(){
		if (kconfig::$dbtype == 'mysql'){
			return mysql_insert_id();
		} elseif (kconfig::$dbtype == 'pgsql') {
			$arr = $this->read();
			return $arr[0];
			
			//die(print_r(pg_fetch_array($this->dbres)));
			//return pg_last_oid($this->dbres);
		}
	}
}
?>