<?php  
class Val {
	public static function input($data){
		$data = trim($data);
		$data = htmlentities($data);
		// $data = htmlspecialchars($data);
		$data = mysql_real_escape_string($data);
		return $data;
	}
}
?>