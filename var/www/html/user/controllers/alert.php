<?php  
	class Alert extends Controller {
		function __construct($dir){
			parent::__construct($dir);
			
		}

		function index(){
			$this->view->title = "404 Not Found";
			$this->view->render("alert/index");
		}
		
	}
?>