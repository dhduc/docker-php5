<?php  
class Error extends Controller {
	function __construct(){
		parent::__construct();
		$this->index();
	}

	function index() {
		echo "<html>
		<head>
			<title>404 Not Found</title>
		</head>
		<body>
			<p><img src='http://media.creativebloq.futurecdn.net/sites/creativebloq.com/files/images/2012/08/error09.jpg' alt='404 Not Found' /></p>
		</body>
		</html>";
	}
}
?>