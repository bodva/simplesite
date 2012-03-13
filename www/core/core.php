<?php if (!defined('defSimpleSite')) {die("Use site core!");}
class core {
	static $errors = array(
		'request' => array (
			'1' => 'con not be empty',
			'2' => 'must be valid',
			'3' => 'can not be an array',
			'4' => 'must be numeric'
			)
		);

	static function debug($varible) {
		global $kbase;
		// print_r($kbase::);
		if (kconfig::$usedebug){
			print_r('<pre>');
			print_r($varible);
			print_r('</pre>');
		}
	}

	static function error($text) {
		if (kconfig::$showerrors) {
			print_r('<div style="color:red;"><pre>');
			print_r($text);
			print_r('</pre></div>');
		}
	}

	static function getrequest($name, $filter = true, $int = false){
		$result = new request($name,$filter,$int);
		if ($result->error){
			core::error('error_numner:'.$result->ecode.'; '.$result->name.' '.self::$errors['request'][$result->ecode]);
			die();
		}
		core::debug($result);
		return $result;
	}
}

class request {
	var $error = false;
	var $ecode = 0;
	var $request = '';

	var $name;
	var $filter = true;
	var $int = false;

	function request($name, $filter, $int) {
		$this->name = $name;
		$this->filter = $filter;
		$this->int = $int;
		
		if (empty($_REQUEST[$this->name])) {
			$this->seterror(1);
		} elseif (is_array($_REQUEST[$this->name])) {
			$this->seterror(3);
		} else {
			if ($this->filter) {
				$this->request = htmlspecialchars($_REQUEST[$this->name]);
			} else {
				$this->request = $_REQUEST[$this->name];
			}
			if ($this->int) {
				if (is_numeric($this->request)){
					$this->request = (int)$this->request;
				} else {
					$this->seterror(4);
				}
			}
			
		}
	}

	function seterror ($code) {
		$this->error = true;
		$this->ecode = $code;
		$this->request = '';
	}

}
?>
