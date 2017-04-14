<?php  
	class Statistic extends Controller {
		function __construct($dir){
			parent::__construct($dir);
			
		}

		function index(){
			$this->view->title = "Statistic";

			$this->view->total = array(
					"total_user" => $this->model->total_user(),
					"total_post" => $this->model->total_post(),
					"total_category" => $this->model->total_category(),
					"total_tag" => $this->model->total_tag()
				);
			$this->view->render("statistic/index");

		}
		
	}
?>