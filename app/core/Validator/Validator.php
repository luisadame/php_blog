<?php
namespace App\Core\Validator;

require_once 'ErrorObject.php';
require_once 'AssertFunctions.php';

	
class Validator extends AssertFunctions {

	protected $rules;
	protected $fields;
	protected $errorMessages;
	protected $errors = [];

	function __construct() {
		$this->errorMessages = require 'ErrorMessages.php';
	}

	public function make( array $data, array $rules ) {

		$this->fields = $data;
		$this->rules = $rules;

		foreach ($this->rules as $key => $value) {

			$evalField = $this->fields[$key];
			$field = $key;

			if (strpos($value, '|')) {

				$values = explode('|', $value);

				foreach ($values as $value) {

					if (strpos($value, ':')) {

						list($method, $argument) = explode(':', $value);

						$arguments = [ $evalField, $argument ];

						if (method_exists($this, $method)) {

							if(!call_user_func_array([$this, $method], $arguments)){
								$this->setError($field, $method, $argument);
							}

						}

					}else{

						$method = $value;
						if(!call_user_func_array([$this, $method], [$evalField])){
							$this->setError($field, $method);
						}

					}
				}

			}else{

				if (strpos($value, ':')) {

					list($method, $argument) = explode(':', $value);

					$arguments = [ $evalField, $argument ];

					if (method_exists($this, $method)) {

						if(!call_user_func_array([$this, $method], $arguments)){
							$this->setError($field, $method, $argument);
						}

					}

				}else{

					$method = $value;
					if(!call_user_func_array([$this, $method], [$evalField])){
						$this->setError($field, $method);
					}

				}

			}

		}

	}

	protected function hasToBeFormatted(string $string) {
		
		if (!strpos($string, '%')) {
			return False;
		}

		return True;

	}

	protected function setError($field, $function, $parameter = null) {
		
		$origin = $function;

		$message = $this->errorMessages[$origin];

		if ($this->hasToBeFormatted($message) && isset($parameter)) {
			if (strpos($parameter, '-')) {
				list($param1, $param2) = explode('-', $parameter);
				$message = sprintf($this->errorMessages[$origin], $param1, $param2);
			}else{				
				$message = sprintf($this->errorMessages[$origin], $parameter);
			}
		}

		$message = preg_replace('/(:field)/', ucfirst($field), $message);
		$this->errors[] = new ErrorObject($field, $origin, $message);		

	}

	public function hasErrors() {
		return (bool) count($this->errors) > 0;
	}

	public function getErrors() {
		return $this->errors;
	}

	public function getErrorByField($field) {
		if ($this->hasErrors()) {
			foreach ($this->errors as $object) {
				if ($object->field === $field) {
					return $object->message;
				}
			}
		}
	}

	public function passes() {
		return (bool) count($this->errors) == 0;
	}

}