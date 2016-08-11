<?php
	
	namespace App;

	use App\Http\Router as Router;

	class Helpers {
		
		function httpQueries(){
			return Router::$queries;
		}
		
	}
