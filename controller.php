<?php

class Controller {

	protected $view_vars = array();
	private $request = array('controller' => NULL, 'action' => NULL, 'params' => array());

	public function __constrct() {
		
	}

	public function set_request($request = array()) {
		$this->request = $request;
	}

	protected function set($view_vars = array()) {
		foreach ($view_vars as $key => $value) 
			$this->view_vars[$key] = $value;
	}
	
	public function render() {
		extract($this->view_vars);
		//echo "hello";
		//include BASE_PATH . 'views/' . $this->request['action'] . '.php';
		if ($this->request['controller'] == 'pages') 
			include BASE_PATH . 'views/' . $this->request['controller'] . '/' . $this->request['params'][0] . '.php';
		else 
			include BASE_PATH . 'views/' . $this->request['controller'] . '/' . $this->request['action'] . '.php';
	}
}
