<?php  
class Bootstrap {
	private $_url = null;
	private $_controllerPath = 'controllers/';
	private $_defaultFile = 'index.php';
	private $_controller = null;
	private $_errorFile = 'Error.php';
	private $_modelPath = 'models/';
	private $_subdir = "application/";
	private $_param = 0;
	private $_viewPath = "views/";
	private $_default = "index";



	public function init(){
		$this->_subdir();
		if(empty($this->_url[$this->_param])){
			$this->_loadDefaultController($this->_default);	
			return false;
		}


		$this->_loadExistingController();
		$this->_callControllerMethod();
	}

	private function _subdir(){
		$this->_getUrl();

		$subdir = unserialize(SUBDIR);
		foreach ($subdir as $key => $value) {
			if($this->_url[0] == $key){
				$this->_subdir = $key."/";
				$this->_default = $value;
				$this->_param = 1;
				return true;
				break;
			}
		}
		
		return false;
		// if($this->_subdir !== "application/") $this->_param = 1;
	}

	private function _getUrl(){
		$url = isset($_GET['url']) ? $_GET['url'] : null;
		$url = rtrim($url, '/');
		$url = filter_var($url, FILTER_SANITIZE_URL);
		$this->_url = explode('/', $url);
		// var_dump($this->_url);

	}

	private function _loadDefaultController($default){
		//echo $this->_subdir.$this->_controllerPath.$default.".php";
		require $this->_subdir.$this->_controllerPath.$default.".php";
		$this->_controller = new $default($this->_subdir);
		$this->_controller->index();
	}

	private function _loadExistingController(){
		$i = $this->_param;

		$file = $this->_subdir.$this->_controllerPath.$this->_url[$i].'.php';
		if(file_exists($file)){
			require $file;
			$this->_controller = new $this->_url[$i]($this->_subdir);
			$this->_controller->loadModel($this->_url[$i], $this->_subdir.$this->_modelPath);
		}
		else {
			$this->_error();
			return false;
		}
	}

	private function _error(){
		require LIB.$this->_errorFile;
		$this->_controller = new Error();
		exit;
	}

	private function _callControllerMethod(){
		$length = count($this->_url);
		if($this->_subdir != "application/") $this->_param = 1;
		$j = $this->_param+1;

        if ($length > $j) {
            if (!method_exists($this->_controller, $this->_url[$j])) {
                $this->_error();
            }

        }   
        switch ($length) {
            case $j+4:           
                $this->_controller->{$this->_url[$j]}($this->_url[$j+1], $this->_url[$j+2], $this->_url[$j+3]);
                break;          
            case $j+3:              
                $this->_controller->{$this->_url[$j]}($this->_url[$j+1], $this->_url[$j+2]);
                break;          
            case $j+2:              
                $this->_controller->{$this->_url[$j]}($this->_url[$j+1]);
                break;          
            case $j+1:             
                $this->_controller->{$this->_url[$j]}();
                break;          
            default:
                $this->_controller->index();
                break;
        }
	}



}
?>