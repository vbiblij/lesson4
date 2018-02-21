<?php 
namespace App;

class Application{
	public $config;
	private $handler;
	public $controller;
	public static $db;
	
	public function __construct($config){
		$this->config = $config;
		$this->connect();
	}
	
	public function run(){
		$this->handler = new \Http\QueryHandler();
		$this->controller = $this->handler->handle($_SERVER['REQUEST_URI']);
		$this->controller->runAction();
	}
	
	public function connect(){
		static::$db = new \PDO($this->config['driver'] . ':host=localhost;dbname=' . $this->config['db'], $this->config['user'], $this->config['pass']);
	}
}
