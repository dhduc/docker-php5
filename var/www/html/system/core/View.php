<?php  
class View {
	private $_dir = "";
	function __construct($dir) {
		$this->_dir = $dir;
	}

	public function render($name, $noInclude = false, $folder=""){
		if ($noInclude == true) {
			// require PATH.$folder.'views/info.php';
			require PATH."/".$this->_dir."/".$folder.'views/' . $name . '.php';    
		}
		else {
			require PATH."/".$this->_dir."/".$folder.'views/info.php';
			require PATH."/".$this->_dir."/".$folder.'views/header.php';
			require PATH."/".$this->_dir."/".$folder.'views/' . $name . '.php';
			require PATH."/".$this->_dir."/".$folder.'views/footer.php';    
		}
	}
}
?>