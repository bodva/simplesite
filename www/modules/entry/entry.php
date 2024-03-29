<?php if (!defined('defSimpleSite')) {die("Use site core!");}  ?>
<?php
class entry {
	var $id;
	var $title;
	var $content;
	var $author;

	static function save($saveid = -1){
		// die($saveid);
		core::debug("save");
		$savepc = new entry;
		if ($saveid != -1) { $savepc->load($saveid);}

		if (!empty($_REQUEST['title'])) {
			// $savepc->title = htmlspecialchars($_REQUEST['title']);
			$savepc->title = core::getrequest('title')->request;
		} else {
			$savepc->title = time();
			// $savepc->title = date("Y-m-d H:i:s:u");
		}
		// $savepc->content = htmlspecialchars($_REQUEST['content']);
		// $savepc->content = $_REQUEST['content'];
		$savepc->content = core::getrequest('content',false)->request;

		$savepc->author = kconfig::$author;
		
		if (core::$nicedie) {
			return $saveid;
		}
		if ($saveid != -1) {
			$savepc->update();
		} else {
			$savepc->add();
		}

		return $savepc->id;
	}

	static function admintable(){
		core::debug("admintable");
		$kd = new kdb;
		$sql = "SELECT 
						n0.eid,
						n0.title
					FROM `simple_entry` as n0
					ORDER BY n0.eid DESC";
		$kd->query($sql);
		$objs = array();
		while ($u0 = $kd->read()){
			$e = array();
			$e['id'] = $u0[0];
			$e['title'] = $u0[1];
			$objs[] = $e;
		}
		unset($kd);
		return $objs;
	}

	function adminentry($id=-1){
		// $entry = new entry;
		if ($id != -1 ) { $this->load($id);}
		$content = '';

		$this->title = (!empty($_REQUEST['title']))?($_REQUEST['title']):($this->title);
		$this->content = (!empty($_REQUEST['content']))?($_REQUEST['content']):($this->content);
		
		$content.= 'ID:'.$this->id;
		$content.= '<br / >';
		$content.= '<input type="hidden" name="id" value="'.$this->id.'">';
		$content.= '<input type="text" name="title" value="'.$this->title.'">';
		$content.= '<br / >';
		$content.= '<textarea name="content" rows=8 cols=80>'.$this->content.'</textarea>';
		$content.= '<br / >';
		$content.= '<input type="submit" name="save">';

		return $content;
	}

	function add () {
		$kd = new kdb;
		$kd->query("INSERT INTO `simple_entry` (
			`eid`,
			`title`,
			`content`,
			`author`
		) VALUES (
			NULL,
			'".mysql_real_escape_string($this->title)."',
			'".mysql_real_escape_string($this->content)."',
			'".mysql_real_escape_string($this->author)."'
		)
			");
		$this->id = $kd->getlastkey();
		unset($kd);

	}

	function update () {
		$kd = new kdb;
		$kd->query("UPDATE `simple_entry`
		SET
			`title` = '".mysql_real_escape_string($this->title)."',
			`content` = '".mysql_real_escape_string($this->content)."',
			`author` = '".mysql_real_escape_string($this->author)."'
		WHERE
			`eid` = '".intval($this->id)."'
		");
		unset($kd);
	}

	static function isexist($id){
		$id = intval($id);
		$result = false;
		$kd = new kdb;
		$kd->query("SELECT `eid` FROM `simple_entry` WHERE `eid`='$id'");
		$arr = $kd->read();
		$result = !empty($arr);
		unset($kd);
		return $result;
	}

	function load ($id) {
		$id = intval($id);
		$kd = new kdb;
		$kd->query("SELECT 
			`eid`,
			`title`,
			`content`,
			`author`
			FROM `simple_entry`
				WHERE `eid`='$id'");
		if ($u0 = $kd->read()){
			$this->id = $u0[0];
			$this->title = $u0[1];
			$this->content = $u0[2];
			$this->author = $u0[3];
		}
	}

	static function getEntrys($col = -1, $page = -1){
		$kd = new kdb;
		$sql = "SELECT 
						n0.eid,
						n0.title,
						n0.content,
						n0.author
					FROM `simple_entry` as n0
					ORDER BY n0.eid DESC";
		if (($page > 0)&&($col>0)) {
			$start = $col*($page-1);
			$end = $col*$page;
			$sql .= " LIMIT $start,$end";
		}
		$kd->query($sql);
		$objs = array();
		while ($u0 = $kd->read()){
			$entry = new entry;
			$entry->id = $u0[0];
			$entry->title = $u0[1];
			$entry->content = $u0[2];
			$entry->author = $u0[3];
			$objs[] = $entry;
		}
		unset($kd);
		return $objs;

	}

	function delete($id){
		$id = intval($id);
		$kd = new kdb;
		$kd->query("DELETE FROM `simple_entry` WHERE `eid`='$id'");
		unset($kd);
	}
}
?>