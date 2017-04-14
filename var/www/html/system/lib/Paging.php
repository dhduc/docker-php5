<?php  
	class Paging {
		private $table;
		private $page;
		public $start;
		public $limit;
		private $condition;
		private $getcons;
		private $_total;
		private $_pages;
		private $_curpage;

		public function __construct($table, $total, $page, $limit, $condition='', $geturl=''){
			$this->table = $table;
			$this->page = $page;
			$this->limit = $limit;
			$this->condition = $condition;
			$this->getcons = $geturl;
			// $this->findTotal();
			$this->_total = $total;
			$this->rowStart();
		}

		private function findTotal(){
			$sql = "SELECT COUNT(*) FROM ".$this->table;
			if(!empty($this->condition)){
				$sql .= $this->condition;
			}
			$rs = mysql_query($sql) or die (mysql_error());
			$row = mysql_fetch_array($rs);
			$this->_total = $row[0];
		}

		private function rowStart(){
			$this->_pages = ceil($this->_total/$this->limit);
			if(isset($this->page)){
				$curpage = $this->page;
				$start = ($curpage-1)*$this->limit;
			}
			else {
				$curpage = 1;
				$start = 0;
			}
			$this->_curpage = $curpage;
			$this->start = $start;
		}

		public function pagesList(){
			$pages = $this->_pages;
			if($pages<=1) {
				return $page_list = "";
				exit;
			}
			$page_list = "";
			$curpage = $this->_curpage;
			if(!empty($this->getcons)){
				$url = "&".$this->getcons;
			}
			else { $url = ""; }

			$uri = $_SERVER['REQUEST_URI'];
			$len = strlen($uri);
			if(strpos($uri, 'page')>-1){
				$arg = explode("/page", $uri);
				$uri = $arg[0];
			}

			$page_list .= "<div id='pagination'>";

			if($curpage>1){
				$page_list .= "<a href='".$uri."/page/1".$url."' class='button'>First</a>";
				$page_list .= "<a href='".$uri."/page/".($curpage-1)."".$url."' class='button'>Prev</a>";
			}
			for ($i=1; $i<=$pages; $i++) { 
				if($i == $curpage){
					$page_list .= "<a href='' class='button button-info'>".$i."</a>";
				}
				else {
					$page_list .= "<a href='".$uri."/page/".$i."".$url."' class='button'>".$i."</a>";
				}
			}
			if($curpage<$pages){
				$page_list .= "<a href='".$uri."/page/".($curpage+1)."".$url."' class='button'>Next</a>";
				$page_list .= "<a href='".$uri."/page/".$pages."".$url."' class='button'>Last</a>";
			}

			$page_list .= "</div>";	


			return $page_list;		
		}

	}
	
	
	// $pagination = new Paging('tb_product',2,$condition='',$geturl='');
	// // Xuất dữ liệu với truy vấn
	// $sql ='SELECT * FROM shops LIMIT '.$pagination->start.', '.$pagination->limit;
	// // Xuất phân trang
	// echo '<p>'.$pagination->pagesList().'</p>';
	// var_dump($pagination);

	// $condition =' WHERE tieude LIKE "%'.$_GET['textsearch'].'%"';
	// $geturl = 'textsearch='.$_GET['textsearch'];
	
	
?>