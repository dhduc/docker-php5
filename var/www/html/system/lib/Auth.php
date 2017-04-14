<?php  
	class Auth {
		public static function handleLogin($session, $url){
			@session_start();
			$logged = $session;
			if($logged == false){
				header('location: '.$url.'');
				exit;
			}
		}
	}
?>