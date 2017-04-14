<?php  
class Login_Model extends Model {
	private $table = "user";
	function __construct(){
		parent::__construct();
	}

	function get_user_by_email($email){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '$email' ";
		return $this->db->get_row($sql);		
	}
}


?>