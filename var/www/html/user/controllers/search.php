<?php  
class Search extends Controller {
	public $url = SITE."/user/category";
	private $user_id = null;
	public $msg = "";
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
		$this->view->title = "Tất cả danh mục";
		$this->page(1);
	}

	function page($page){
		$key = "";
		$table = "";
		if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit_search'])) {
			if (isset($_POST['inp_search']) && !empty($_POST['inp_search']) ) {
				$key = $_POST['inp_search'];

				$data = $this->model->get_all_post($page, " user_id = {$this->user_id} and (post_title like '%$key%' or post_content like '%$key%' )  ");
				$this->view->pagelist = $this->model->pagelist;

				if (isset($data) && !empty($data) && $data != null ) {
					$table = "<table width='90%'>
					<th>Tiêu đề bài viết</th>";
					$i = 0;
					foreach ($data as $row) {
						$i++;
						$table .= "<tr>
						<td> <a href='".SITE."/user/post/detail/{$row['post_id']}'>{$row['post_title']}</a><br> 
						</td>
						</tr>";
					}
					$table .= "</table>";
				}
				else {
					$table = "";
				}

			}
		}
		
		$this->view->key = $key;
		$this->view->data = $table;	
		$this->view->render("search/index");
	}


}
?>