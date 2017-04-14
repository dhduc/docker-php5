<?php  
class Dashboard_Model extends Model {
	private $table = "user";
	private $key = "userid";
	function __construct(){
		parent::__construct();
	}

	function get_user_by_email($email){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '$email' ";
		return $this->db->get_row($sql);		
	}

	function get_user_by_id($id){
		$sql = "SELECT * FROM ".$this->table." WHERE user_id = '$id' ";
		return $this->db->get_row($sql);		
	}
}


?>