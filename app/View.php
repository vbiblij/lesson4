<?php
namespace App;

class View {
	protected $path;
	protected $vars;
	
	public function __construct($path){
		$this->setPath($path);
	}
	
	public function setPath($path){
		if(file_exists($path)){
			$this->path = $path;
		}else{
			throw new \Exception('View file was not found');
		}
	}
	
	public function getPath(){
		return $this->path;
	}
	
	public function setVars($vars){
		$this->vars = $vars;
	}
	
	public function render(){
		extract($this->vars);	
		include($this->getPath());
		/*
		ob_start();
		extract($this->vars);		
		include($this->getPath());
		$content = ob_get_contents();
		ob_end_clean();
		return $content;*/
	}
}
