<?php
	
	namespace App;

	use App\Http\Router as Router;

	class Helpers {
		
		function httpQueries(){
			return Router::$queries;
		}

		function e($string) {
			return strip_tags($string, '<p><img><b>');
		}

		function limit($string, $offset) {
			$string = substr(self::e($string), 0, $offset);
			$string .= '...';

			return $string;
		}

		function delimiter($string) {
			$offset = strpos($string, '#delimiter#');

			if (!$offset) {
				return self::e($string);
			}

			$string = substr(self::e($string), 0, $offset);
			// $string .= '...';

			return $string;
		}

		function substract($string) {			
			$string =  preg_replace('/#delimiter#/', '', $string);
			return $string;
		}
		
		function escapeAndSubstract($string) {
			$string = self::e($string);
			$string = self::substract($string);
			return $string;
		}

	}
