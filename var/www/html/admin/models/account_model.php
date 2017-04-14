<?php  
class Account_Model extends Model {
	public $table = "admin";
	private $key = "admin_id";
	function __construct(){
		parent::__construct();
	}

	function get_admin_by_email($id){
		$sql = "SELECT * FROM ".$this->table." WHERE email = '$id' ";
		return $this->db->get_row($sql);	
		//echo $sql;	
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