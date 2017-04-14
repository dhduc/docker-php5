<?php  
class Category_Model extends Model {
	public $table = "category";
	private $key = "category_id";
	private $limit = 2;
	public $pagelist = "";
	function __construct(){
		parent::__construct();
	}

	function get_total($where = ""){
		$sql = "SELECT COUNT(*) FROM ".$this->table." where ".$where;
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}

	function get_all_category($page, $where = ""){
		$total = $this->get_total($where);
		$pagi = new Paging($this->table, $total, $page, $this->limit, $getcon='', $url='');
		$sql = "select * from ".$this->table." where $where order by date_modified desc limit ".$pagi->start.", ".$pagi->limit." ";
		$this->pagelist = $pagi->pagesList();
		return $this->db->get_list($sql);		
	}

	function get_category_by_id($id, $where = ""){
		$sql = "SELECT * FROM ".$this->table." WHERE {$this->key} = '$id' $where ";
		return $this->db->get_row($sql);		
	}

	function get_category_by_name($name){
		$sql = "SELECT * FROM ".$this->table." WHERE category_name = '$name' ";
		return $this->db->get_row($sql);		
	}

	

	function insert_category($data){
		return $this->db->insert($this->table, $data);
	}

	function update_category($data, $id, $user_id){
		return $this->db->update($this->table, $data, "{$this->key} = '$id' and user_id = '$user_id' ");
	}

	function delete_category($id, $user_id){
		return $this->db->remove($this->table, " {$this->key} = '$id' and user_id = '$user_id' ");
	}

	function update_post($id, $user_id){
		return $this->db->update("post", array("category_id" => 0), "category_id = '$id' and user_id = '$user_id' ");
	}

	
}


?>