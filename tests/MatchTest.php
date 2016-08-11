<?php

	use PHPUnit\Framework\TestCase;

	class MatchTest extends TestCase {

		public function testOne() {
			$uri = '/post12/1123as';

			$this->assertThat(preg_match('/\/post\/([0-9])+/', $uri));

		}

	}