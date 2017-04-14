<?php  
class User_Model extends Model {
	public $table = "user";
	private $key = "user_id";
	private $limit = 10;
	public  $pagelist = ""; 
	function __construct(){
		parent::__construct();
	}

	function get_total(){
		$sql = "SELECT COUNT(*) FROM ".$this->table;
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}

	function get_all_user($page){
		$total = $this->get_total();
		$pagi = new Paging($this->table, $total, $page, $this->limit, $getcon='', $url='');
		$sql = "select * from ".$this->table." order by datetime desc limit ".$pagi->start.", ".$pagi->limit." ";
		$this->pagelist = $pagi->pagesList();
		return $this->db->get_list($sql);		
	}

	function get_user_by_id($id){
		$sql = "SELECT * FROM ".$this->table." WHERE {$this->key} = '$id' ";
		return $this->db->get_row($sql);		
	}

	function get_all_category($sql){
		return $this->db->get_list($sql);		
	}

	function get_cat_in_user($sql){
		return $this->db->get_list($sql);	
	}

	function get_tag_in_user($sql){
		return $this->db->get_list($sql);	
	}

	function get_category_by_id($id){
		$sql = "SELECT * FROM category WHERE category_id = '$id' ";
		return $this->db->get_row($sql);		
	}

	function get_all_tag($sql){
		return $this->db->get_list($sql);		
	}

	function get_tag_by_id($id){
		$sql = "SELECT * FROM tag WHERE tag_id = '$id' ";
		return $this->db->get_row($sql);		
	}

	function total_post($user_id){
		$sql = "SELECT COUNT(*) FROM post where user_id = '$user_id' ";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_category($user_id){
		$sql = "SELECT COUNT(*) FROM category where user_id = '$user_id' ";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_tag($user_id){
		$sql = "SELECT COUNT(*) FROM tag where user_id = '$user_id' ";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
}


?>