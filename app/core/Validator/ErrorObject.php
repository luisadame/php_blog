<?php	
	namespace App\Core\Validator;

	class ErrorObject {

		protected $origin;
		public $message;
		public $field;

		function __construct($field, $origin, $message){
			$this->field = $field;
			$this->origin = $origin;
			$this->message = $message;
		}	

	}