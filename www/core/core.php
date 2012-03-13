<?php if (!defined('defSimpleSite')) {die("Use site core!");}
class core {
	static function debug($varible) {
		global $kbase;
		// print_r($kbase::);
		if (kconfig::$usedebug){
			print_r('<pre>');
			print_r($varible);
			print_r('</pre>');
		}
	}
}
?>
