<?php  
	class Statistic extends Controller {
		private $user_id = null;
		function __construct($dir){
			parent::__construct($dir);
			$this->init();
		}

		function init(){
		if ( isset($_SESSION['user_login']) && !empty($_SESSION['user_login']) ) {
			$this->user_id = $_SESSION['user_login'];
		}
		else {
			Url::redirect("../../index");
			exit();
		}

		}
		function index(){
			$this->view->title = "Statistic";

			$this->view->total = array(
					"total_post" => $this->model->total_post($this->user_id),
					"total_category" => $this->model->total_category($this->user_id),
					"total_tag" => $this->model->total_tag($this->user_id)
				);
			$this->view->render("statistic/index");

		}
		
	}
?>