<?php 
namespace Controllers;

abstract class Controller{	
	public $action;
	
	public function __construct($action){
		$this->action = $action;
	}
	
	public function runAction(){
		if (method_exists($this, $this->action)) {
			return $this->{$this->action}();
		}
		
		throw new \Exception('Requested URL was not found', 404);
	}
	
	public function render($viewID, array $variables){
		$viewPath = $_SERVER['DOCUMENT_ROOT']."/lesson4/resources/views/$viewID.php";

		if(file_exists($viewPath)){
			$view = new \App\View($viewPath);
			$view->setVars($variables);
			
			return $view->render();
		}
		
		throw new \Exception('View was not found');
	}
	
	/*public function view($view, array()){
		if (file_exists($view->path)){
		}
		
		throw new \Exception('');
	}*/
}