<?php
if (!defined('defSimpleSite')) {die("Use site core!");}

class kuser{

var $userid;
var $user;
var $passwd;
private $login = false;
private $admin = false;
//private $saler = false;

	private function set($userid, $user, $passwd='', $login=true/*, $saler*/){
			$this->userid = $userid;
			$this->user = $user;
			$this->passwd = $passwd;
			$this->login = $login;
			//$this->saler = $saler;
	}
	
	private function load($uid){
		$kd = new kdb;
		$kd->query("SELECT `userid`,`login`, `isadmin` FROM `simple_users` WHERE `userid`='".$uid."'");
		while ($u0 = $kd->read()) {
			$this->userid = $u0[0];
			$this->user = $u0[1];
			$this->passwd = '';
			if ($u0[2]==1) {$this->admin = true;}
			// $this->admin = $u0[2];
			$this->login = true;
		}
	}

	function setLogin($user, $passwd){
		//echo "setLogin<br>";
		// verify user
		$kd = new kdb;
		//echo $user.'<br>';
		//if (kconfig::$dbtype == 'mysql'){
			$kd->query("SELECT `userid`,`login`,`pswd`, `isadmin` FROM `simple_users` WHERE `login`='".$user."'");
		//} elseif (kconfig::$dbtype == 'pgsql') {
		//	$kd->query("SELECT \"userid\", \"user\", \"passwd\", \"isadmin\", \"issaler\" FROM k_users WHERE \"user\"='".$user."'");
		//}
		while ($u0 = $kd->read()) {
			// core::debug($u0);
			$userid = $u0[0];
			if ($passwd==$u0[2]){
				$this->login = true;
				if ($u0[3]==1) {$this->admin = true;}
				//if ($u0[4]==1) {$this->saler = true;}
			}
		}
		//echo '<br>';
		unset($kd);
		//set cookies
		if ($this->login){		
			$this->set($userid, $user, $passwd, true/*, $this->saler*/);	
			$this->setcookie($userid,$user,$passwd);
		}
		// core::debug($this);
	}

	function isadmin(){
		return $this->admin;
	}
	
	function issaler(){
		//return $this->saler;
	}

	private function setcookie($userid, $user,$passwd){
		//set user login session
		//echo 'start set session<br>';
		//if (((isset($_POST['uname'])) AND (isset($_POST['passwd'])))) {
	        //unset($_SESSION);
	        $login['userid'] = $this->userid;
	        // $login['user'] = $this->user;
	        $nowhash = md5($this->userid+$_SERVER["REMOTE_ADDR"]+$_SERVER["HTTP_USER_AGENT"]);
	        $login['nowhash'] = $nowhash;
	        //$login['passwd'] = $this->passwd;
	      //  if (!isset($_SESSION['login'])){
	        $_SESSION['login'] = $login;
	      //  }
    	//}
		//echo 'end set session<br>';
		//print_r($_SESSION);
	}

	private function rmcookie(){
		//echo 'rm cookie<br>';
		unset($_SESSION['login']);
		//session_unregister('login');
		//$_SESSION = array();
   		// Удалить cookie, соответствующую Suserid
   		unset($_COOKIE[session_name()]);

   		// Уничтожить хранилище сессии
   		session_destroy();
   		//print_r($_SESSION);
		//echo 'rm session<br>';
	}
	private function issession(){
		//echo 'issession<br>';
		//print_r($_SESSION);
		//print_r($_COOKIE);
		//return isset($_SESSION['login']);
		// if (session) {				
		//}		
	}
	function islogin(){
		if (!empty($_SESSION['login'])){
			$arr = $_SESSION['login'];
			if (!empty($arr['userid'])){
				$sessionhash = $arr['nowhash'];
				$nowhash = md5($arr['userid']+$_SERVER["REMOTE_ADDR"]+$_SERVER["HTTP_USER_AGENT"]);
				if ($sessionhash == $nowhash) {
                    return true;
                    $this->userid = $arr['userid'];
                } else {
                	return false;
                }
			} else {
				return false;
			}
		} else {
			return false;
		}
		//echo "hihi".(int)$this->login;
		//echo "is login<br>".(int)$this->login;
		//print_r($_SESSION);
		/*if ($this->issession()) {
			$this->load($_SESSION['login']['userid'],$_SESSION['login']['user'],$_SESSION['login']['passwd']);
		}*/
		return $this->login;
		//return false;
	}

	function getID(){
		return $this->userid;
	}

	function setLogout(){
		//echo 'set logout<br>';
		$this->login = false;
		$this->rmcookie();
		//rm cookie
	}
	/*function __destruct(){
		//logout
		echo "destruct user<br>";
		$this->login = false;
		//rm cookie
	}*/
}
?>