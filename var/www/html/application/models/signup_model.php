<?php  
class Signup_Model extends Model {
	private $table = "user";
	function __construct(){
		parent::__construct();
	}
	function check_email($email){
		$sql = "SELECT email FROM ".$this->table." WHERE email = '$email' ";
		return $this->db->get_row($sql);
		
	}

	function add_new($data){
			return $this->db->insert($this->table, $data);
	}
}
?>