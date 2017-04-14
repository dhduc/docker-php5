<?php  
class Statistic_Model extends Model {
	function __construct(){
		parent::__construct();
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