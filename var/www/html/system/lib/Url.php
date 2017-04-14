<?php  
	class Url {
		public static function redirect($url = null){
			if (!curl_init($url)) {
				echo("Path : $url not found");
			}
			else {
				header("location: ".$url);
			}
		}
	}
?>