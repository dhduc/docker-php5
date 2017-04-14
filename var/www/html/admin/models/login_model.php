<?php  
class Login_Model extends Model {
	private $table = "admin";
	private $key = "adminid";
	function __construct(){
		parent::__construct();
	}

	function get_admin_by_email($email){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '$email' ";
		return $this->db->get_row($sql);		
	}
}


?>