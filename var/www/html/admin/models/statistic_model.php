<?php  
class Statistic_Model extends Model {
	function __construct(){
		parent::__construct();
	}

	function total_user(){
		$sql = "SELECT COUNT(*) FROM user";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];

	}
	function total_post(){
		$sql = "SELECT COUNT(*) FROM post";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_category(){
		$sql = "SELECT COUNT(*) FROM category";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
	function total_tag(){
		$sql = "SELECT COUNT(*) FROM tag";
		$row = $this->db->get_row($sql);
		return $row["COUNT(*)"];
	}
}


?>