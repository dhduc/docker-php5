<?php  
class Account_Model extends Model {
	public $table = "user";
	private $key = "user_id";
	function __construct(){
		parent::__construct();
	}

	function get_user_by_id($id){
		$sql = "SELECT * FROM ".$this->table." WHERE user_id = '$id' ";
		return $this->db->get_row($sql);		
	}

	function update($data, $user_id){
		return $this->db->update($this->table, $data, "{$this->key} =  '$user_id' ");
	}
	
}


?>