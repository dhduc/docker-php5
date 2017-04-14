<?php  
class Tag_Model extends Model {
	public $table = "tag";
	private $key = "tag_id";
	function __construct(){
		parent::__construct();
	}

	function get_all_tag($user_id){
		$sql = "select * from tag where user_id = '$user_id' ";
		return $this->db->get_list($sql);		
	}

	function get_tag_by_id($id, $user_id){
		$sql = "SELECT * FROM ".$this->table." WHERE {$this->key} = '$id' and user_id = '$user_id' ";
		return $this->db->get_row($sql);		
	}


	function insert_tag($data){
		return $this->db->insert($this->table, $data);
	}

	function update_tag($data, $id, $user_id){
		return $this->db->update($this->table, $data, "{$this->key} = '$id' and user_id = '$user_id' ");
	}

	function delete_tag($id, $user_id){
		return $this->db->remove($this->table, " {$this->key} = '$id' and user_id = '$user_id' ");
	}

	function update_post($id, $user_id){
		return $this->db->update("post", array("tag_id" => 0), "tag_id = '$id' and user_id = '$user_id' ");
	}
	
	
}


?>