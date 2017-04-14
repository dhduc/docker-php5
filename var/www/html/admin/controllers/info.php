<?php  
	class Info extends Controller {
		function __construct($dir){
			parent::__construct($dir);
		}

		function index(){
			$this->view->title = "Info";
			$this->view->render("info/index");
		}

		function info(){
			$this->view->title = "Info Page";
			$this->view->render("info/info");
		}
	}
?>