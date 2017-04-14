<?php  
class Search_Model extends Model {
	public $table = "post";
	private $key = "post_id";
	private $limit = 5;
	public $pagelist = "";
	function __construct(){
		parent::__construct();
	}

	function get_total($where = ""){
		$sql = "SELECT COUNT(*) FROM ".$this->table." where ".$where;
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}

	function get_all_post($page, $where = ""){
		$total = $this->get_total($where);
		$pagi = new Paging($this->table, $total, $page, $this->limit, $getcon='', $url='');
		$sql = "select * from ".$this->table." where $where order by date_modified desc limit ".$pagi->start.", ".$pagi->limit." ";
		$this->pagelist = $pagi->pagesList();
		return $this->db->get_list($sql);		
	}

	

	
	
}


?>