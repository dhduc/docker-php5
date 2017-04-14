<?php  
	require '../config.php';
	

	function __autoload($class){
		if(file_exists('../system/core/'.$class.'.php')) {
			require '../system/core/'.$class.'.php';
		}
		if(file_exists('../system/database/'.$class.'.php')) {
			require '../system/database/'.$class.'.php';
		}
		if(file_exists('../system/lib/'.$class.'.php')) {
			require '../system/lib/'.$class.'.php';
		}
	}
	
	$admin = new Bootstrap();
	$admin->init("dashboard");
?>