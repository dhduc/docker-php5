<?php  
class Dashboard_Model extends Model {
	private $table = "admin";
	private $key = "admin_id";
	private $limit = 5;
	function __construct(){
		parent::__construct();
	}

	function get_admin_by_email($email){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '$email' ";
		return $this->db->get_row($sql);		
	}

	function get_total(){
		$sql = "SELECT COUNT(*) FROM ".$this->table;
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}

	function get_all_user($page = 1){
		$total = $this->get_total();
		$pagi = new Paging($this->table, $total, $page, $this->limit, $getcon='', $url='');
		$sql = "select * from user order by datetime desc limit ".$pagi->start.", ".$pagi->limit." ";
		$this->pagelist = $pagi->pagesList();
		return $this->db->get_list($sql);		
	}

	function total_user(){
		$sql = "SELECT COUNT(*) FROM user";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];

	}
	function total_post(){
		$sql = "SELECT COUNT(*) FROM post";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_category(){
		$sql = "SELECT COUNT(*) FROM category";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_tag(){
		$sql = "SELECT COUNT(*) FROM tag";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
}


?>