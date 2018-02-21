<?php 
namespace Http;

class QueryHandler{
	private static $handler;
	
	public function routes(){
		return [
			'main/index' => 'IndexController@index',
			'post/hello' => 'PostController@index' 
		];
	}
	
	public function handle($requestURI){
		$requestURI = str_replace('/lesson4/', '', $requestURI);
		//разделяем полученную строку по слэшам
		$URIComponents = explode('/', $requestURI);

		//имя контроллера будет лежать в первой ячейке
		$controllerID = $URIComponents[0];
		if (empty($controllerID))
			$controllerID = 'main';
		
		//проверяем не пусто ли там
		if(is_string($controllerID)){			
			//если экшен не пустой - устанавливаем полученное значение,
			//если пустой - устанавливаем значение по-умолчанию - 'index'
			$actionID = !empty($URIComponents[1]) && is_string($URIComponents[1]) ? $URIComponents[1] : 'index';
			
			//получаем знаечение роутов, которые прописывали вручную в routes()
			$routes = $this->routes();
			
			//если запрошенный роут существует - продолжаем
			if(array_key_exists("$controllerID/$actionID", $routes)){				
				//получаем имя контроллера и экшена
				$route = $routes["$controllerID/$actionID"];

				//разделяем их по знаку @
				$routeParams = explode('@', $route);
				
				//название класса контроллера лежит в нулевой ячейке
				$controllerClassName = $routeParams[0];
				
				//название экшена (метода контроллера) лежит в первой ячейке
				$actionName = $routeParams[1];

				//получаем полный путь к классу контроллера, используя его namespace
				$controllerNamespace = "\Controllers\\" . $controllerClassName;

				//проверяем существует ли класс контроллера
				if(class_exists($controllerNamespace)){
					//если класс контроллера сущетсвует - создаем его экземпляр
					$controllerClass = new $controllerNamespace($actionName);

					//проверяем сущетвует ли в нем метод, одноименный з название экшена
					if(method_exists($controllerClass, $actionName)){
						return $controllerClass; //возвращаем экземпляр контроллера
					}
				}
			}
		}
		
		//если на каком-то этапе что-то где-то пошло не так - пользователь ввел неправильную URL
		throw new \Exception('Requested URL was not found', 404);
	}
}