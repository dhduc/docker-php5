<?php  
class User extends Controller {
	private $msg = "";
	private $dialog = "";
	function __construct($dir){
		parent::__construct($dir);

	}
	function index(){
		$this->view->title = "All User";
		$this->page(1);
	}
	function page($page){
		$total = $this->model->get_total();
		$data = $this->model->get_all_user($page);
		$this->view->pagelist = $this->model->pagelist;

		if (isset($data) && !empty($data) && $data != null ) {
			$table = "<h3>Total user: $total</h3><table width='90%'>
			<th>STT</th>
			
			<th>Username</th>
			<th>Fullname</th>
			<th>Email</th>
			";
			$i = 0;
			foreach ($data as $row) {
				$i++;
				$table .= "<tr>
				<td>$i</td>
				
				<td> <a href='".SITE."/admin/user/detail/{$row['user_id']}'>{$row['username']}</a><br> 
				</td>
				<td>{$row['fullname']}</td>
				<td>{$row['email']}</td>
				</tr>";
			}
			$table .= "</table>";
		}
		else {
			$table = "";
		}
		
		$this->view->data = $table;
		$this->view->render("user/index");
	}

	

	function detail($id){
		$this->view->title = "Chi tiết bài viết";

		$data = $this->model->get_user_by_id($id);
			if ($data == false) {
				$this->logout();
			}
		$this->view->total = array(
					"total_post" => $this->model->total_post($data['user_id']),
					"total_category" => $this->model->total_category($data['user_id']),
					"total_tag" => $this->model->total_tag($data['user_id'])
				);	
		$this->view->data = $data;
		$this->view->render("user/detail");

	}

	
}


?>