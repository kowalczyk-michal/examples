<?php
abstract class Controller {
	protected $arguments;
	protected $cliModel;
	
	public function __construct() {
		//CliModel should be loaded everytime
		$this->cliModel = $this->loadModel('Cli');
	}
	
	/*
	 *	Load Model to Controller
	 */
	public function loadModel($model, $param='') {
		$modelName = $model.'Model';
		$file = 'model/'.$modelName.'.php';
		
		//check if model exists
		
		if (is_file($file)) {
			require_once($file);
			$ob = new $modelName($param);
			
			return $ob;
		}
		else return false;
	}
	
	/*
	 *	Get arguments/parameters from command line
	 */
	protected function getArguments($args) {
		$this->arguments = $this->cliModel->parseArguments($args); //parse arguments
	}
}