<?php  
class Account extends Controller {
	public $url = SITE."/admin/account";
	public $msg = "";
	function __construct($dir){
		parent::__construct($dir);
	}

	function index(){
		$this->view->title = "Tài khoản";
		$this->display();
		
		
	}

	function display(){	
		$data = $this->model->get_admin_by_email($_SESSION["admin_login"]);
			if ($data == false) {
				$this->logout();
			}
		$this->view->data = $data;
		$this->view->render("account/index");	
	}

	
}
?>