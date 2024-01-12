<?php
class Router {
	private static $controllerNamespace='App\\Controllers\\';

	public static $routes = [
		'GET'  => [],
		"POST" => [],
		"DELETE" => [],
		"PATCH" => [],
		"OPTIONS" => [],
		"PUT" => []
	];
	
	
	/**
	 * @param $uri
	 * @param $controller
	 *
	 * @return mixed
	 */
	public static function get( $uri, $controller ) {
		
		return self::$routes["GET"][ trim($uri,'/') ] = $controller;
	}
	
	public static function post( $uri, $controller ) {
		
		return self::$routes["POST"][ trim($uri,'/') ] = $controller;
	}

    public static function delete( $uri, $controller ) {

        return self::$routes["DELETE"][ trim($uri,'/') ] = $controller;
    }

    public static function patch( $uri, $controller ) {

        return self::$routes["PATCH"][ trim($uri,'/') ] = $controller;
    }

    /**
     * @param array $files
     * @return Router
     */
    public static function load($files=[] ) {
	    $instance = new static();

        foreach ($files as $file) {
         require_once $file;
		}
		return $instance;
	}
	
	public static function direct( $uri,$requestType ) {
			if (!isset(self::$routes[$requestType])) {
				http_response_code(503);
				header('Content-type: application/json');
				echo json_encode([
					'status' => 'error',
					'message' => 'Bad Request. Unknown request method ' . $requestType,
					'code' => 503
				]);
				return 1;
			}
		
			foreach (self::$routes[$requestType] as $route => $controllerAction) {
				$pattern = preg_replace('/\/{(.*?)}/', '/(.*?)', $route);
				$pattern = str_replace('/', '\/', $pattern);
				
				if (preg_match('/^' . $pattern . '$/', $uri, $matches)) {
					array_shift($matches); // Remove a correspondência completa no índice 0
					$controller = explode('@', $controllerAction);
					return static::mapController(
						$controller[0],$controller[1],$matches
					);
				}
			}
		
			// Retorne uma página de erro geral
			view("errors/404");
			return 1;
		


	    /*if(!isset(self::$routes[$requestType])){
	        http_response_code(503);
            header('Content-type:application/json');
            echo json_encode(['status'=>'error','message'=>'Bad Request. Unknown request method '.$requestType,
                'code'=>503]);
            return 1;        }

		if(array_key_exists(trim($uri,'/'),self::$routes[$requestType])){
			
			return static::mapController(
				...explode('@',
				self::$routes[$requestType][$uri]
				));
			
		}
		//return an error general page
		 view("errors/404");
		return 1;*/
	}


    /**
     * @param $controller
     * @param $action
     * @return mixed
     */
    protected static function mapController($controller, $action,...$params){
		$controller=(self::$controllerNamespace.$controller);

		$controller=new $controller; //renew the controller class
		

		if(!method_exists($controller,$action)){
			//return an error page
			 view("errors/500");
			 return 1;
		}
		
		return $controller->$action(...$params);
		
	}
}