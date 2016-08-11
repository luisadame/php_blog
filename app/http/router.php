<?php

	namespace App\Http;

	use App\Config\Config as Config;
	use App\Helpers as Help;

	class Router {

		public static $routes;
		public static $matchables;
		public static $current;
		public static $controller;
		public static $queries;

		function __construct(){
			self::$current = $this->filterURI();
		}

		private function setQueries($queries){

			foreach (explode('&', $queries) as $key) {
				self::$queries[explode('=', $key)[0]] = explode('=', $key)[1];
			}

		}

		private function filterURI(){

			$fullURL = filter_input(INPUT_SERVER, 'REQUEST_URI');
			
			if (!$_SERVER['QUERY_STRING']) {
				
				return $fullURL;

			}

			$urlSlices = explode('?', $fullURL, 2);
			self::setQueries($urlSlices[1]);
			return $urlSlices[0];

		}

		public static function set($route, $function){

			$route = self::validRoute($route);

			self::$routes[$route] = $function;

		}

		public static function match($givenRoute, $expectedParams, $function){

			if (is_array($expectedParams)) {			
				self::$matchables[$givenRoute] = ['params' => $expectedParams, 'func' => $function];
			}

		}

		private static function doesMatch() {
			
			foreach (self::$matchables as $route => $value) {
				if (preg_match($route, self::$current))					
					return True;
			}

		}

		private static function matchResolver() {

			$matchedRoute = '';
			$foundParams = [];

			foreach (self::$matchables as $route => $value) {

				if(preg_match( $route, self::$current, $params )){

					$matchedRoute = $route;
					$expectedParams = self::$matchables[$matchedRoute]['params'];
					$func = self::$matchables[$matchedRoute]['func'];

					foreach ($expectedParams as $key) {
						if (key_exists($key, $params)) {
							$foundParams[$key] = $params[$key];
						}
					}


					if (is_callable($func)) {
						return self::$matchables[$matchedRoute]['func']($foundParams);
					}else{
						self::call_controller($func, $foundParams);
					}

				}

			}

		}

		private function validRoute($route){

			if (strpos($route, '/') !== 0) {
				return str_pad($route, strlen($route) + 1, '/', STR_PAD_LEFT);
			}

			return $route;
		}

		public static function call_controller($controller, $params = null){
			
			$controller_name 	=	explode('@', $controller)[0];
			$controller_func 	=	explode('@', $controller)[1];
			$controllers_folder =	Config::get('controllers_path');
			$fullpathtofile 	=	$controllers_folder . '/' . $controller_name . '.php';

			if (file_exists($fullpathtofile)) {

				include $fullpathtofile;

				$controller = new $controller_name;

				if (!isset($params)) {
					$controller->$controller_func();
				}else{
					$controller->$controller_func($params);
				}

			} else {
				throw new Exception("Controller not found");				
			}

		}

		public static function request(){

			if (key_exists(self::$current, self::$routes)) {

				if (!is_callable(self::$routes[self::$current])) {
					self::call_controller(self::$routes[self::$current]);				
				}else{
					return self::$routes[self::$current]();					
				}

			}

			if (self::doesMatch()) {
				self::matchResolver();
			}else{
				// echo "Not found";
			}

		}
		
	}