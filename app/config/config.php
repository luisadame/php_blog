<?php

	namespace App\Config;

	class Config {

		private static $settings;

		function __construct() {
			self::$settings = require 'settings.php';
		}

		public static function show(){
			return self::$settings;
		}

		public static function set($key, $value){
			self::$settings[$key] = $value;
		}

		public static function get($key){
			return self::$settings[$key];			
		}

	}

