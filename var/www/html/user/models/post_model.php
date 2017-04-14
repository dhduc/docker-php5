<?php  
class Post_Model extends Model {
	private $table = "post";
	private $key = "post_id";
	private $limit = 2;
	public  $pagelist = ""; 
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

	function insert_post($data){
		return $this->db->insert($this->table, $data);
	}

	function get_post_by_id($id, $user_id){
		$sql = "SELECT * FROM ".$this->table." WHERE {$this->key} = '$id' and user_id = '$user_id' ";
		return $this->db->get_row($sql);		
	}

	function update_post($data, $id, $user_id){
		return $this->db->update($this->table, $data, "{$this->key} = '$id' and user_id = '$user_id' ");
	}

	function delete_post($id, $user_id){
		return $this->db->remove($this->table, " {$this->key} = '$id' and user_id = '$user_id' ");
	}

	function get_all_category($user_id){
		$sql = "select * from category where user_id = '$user_id' order by date_modified desc ";
		return $this->db->get_list($sql);		
	}

	function get_cat_in_post($user_id){
		$sql = "select * from category where category_id in (select distinct category_id from post where user_id = '$user_id') and user_id = '$user_id'";
		return $this->db->get_list($sql);	
	}

	function get_tag_in_post($user_id){
		$sql = "select * from tag where tag_id in (select distinct tag_id from post where user_id = '$user_id') and user_id = '$user_id' ";
		return $this->db->get_list($sql);	
	}

	function get_category_by_id($id, $user_id){
		$sql = "SELECT * FROM category WHERE category_id = '$id' AND user_id = '$user_id' ";
		return $this->db->get_row($sql);		
	}

	function get_all_tag($user_id){
		$sql = "select * from tag where user_id = '$user_id' ";
		return $this->db->get_list($sql);		
	}

	function get_tag_by_id($id, $user_id){
		$sql = "SELECT * FROM tag WHERE tag_id = '$id' AND user_id = '$user_id' ";
		return $this->db->get_row($sql);		
	}
}


?>