<?php
	namespace App\Core\Validator;

	class AssertFunctions {

		protected function min(string $string, int $limit) {
			if (strlen($string) < $limit) {
				return False;
			}
			
			return True;
		}

		protected function max(string $string, int $limit) {
			if (strlen($string) > $limit) {
				return False;
			}

			return True;
		}
		
		public function between($eval, $args) {

			if (strpos($args, '-')) {
				list($min, $max) = explode('-', $args);
				$min = intval($min);
				$max = intval($max);
			}else{
				throw new Exception("Too few arguments");				
			}

			if ($this->string($eval)) {
				if (strlen($eval) < $min || strlen($eval) > $max) {
					return False;
				}else{
					return True;			
				}
			}

			if ($this->number($eval)) {
				if ($eval < $min || $eval > $max) {
					return False;
				}

				return True;
			}

		}


		protected function number($integer) {
			if (!is_int($integer)) {
				return False;
			}

			return True;
		}

		protected function required($arg) {
			if (!isset($arg) || empty($arg)) {
				return False;
			}

			return True;
		}

		protected function isAdult(int $integer) {
			if ($integer < 18) {
				return False;
			}
			return True;
		}

		protected function email(string $email) {
			if (!preg_match('/[A-Za-z0-9.]+@\w+\.\w+/', $email)) {
				return False;
			}
			return True;
		}

		protected function string($string) {
			if (!is_string($string)) {
				return False;
			}
			return True;
		}
		
	}