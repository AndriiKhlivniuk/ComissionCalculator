<?php

class CommissionCalculatorTest extends \PHPUnit\Framework\TestCase{

	public function testCommisionCalculator(){

		$a = new App\CommissionCalculator;
		$result = $a->calculator('{"bin":"45717360","amount":"100.00","currency":"EUR"}');
		$this->assertEquals(1, $result);

		$result = $a->calculator('{"bin":"516793","amount":"50.00","currency":"USD"}');
		$this->assertEquals(0.5, $result);

		/*$result = $a->calculator('{"bin":"45417360","amount":"10000.00","currency":"JPY"}');
		$this->assertEquals(1.39, $result);

		$result = $a->calculator('{"bin":"41417360","amount":"130.00","currency":"USD"}');
		$this->assertEquals(2.6, $result);

		$result = $a->calculator('{"bin":"4745030","amount":"2000.00","currency":"GBP"}');
		$this->assertEquals(45.72, $result);*/

	}
}

?>