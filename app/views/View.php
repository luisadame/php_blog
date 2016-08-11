<?php
	
	namespace App\Views;	

	use App\Config\Config as Config;
	
	class View {

		public static $data;

		public static function make($view, $args = null){
			$filetopath = Config::get('views_path') . '/' . $view . '.php';

			if (isset($args) && is_array($args)) {
				self::$data = $args;
			}

			$data = self::$data;

			include $filetopath;
		}

	}