<?php
class jpWargamingReaderWowsTest extends PHPUnit_Framework_TestCase
{
	protected function getReader()
	{
		return new jpWargamingReaderWows('03e3653b14d26e8136d5870a1512e3c4', 'EU');
	}

	public function test_returnTypes()
	{
		$expected = '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}';

		// raw json
		$reader = $this->getReader();
		$result = $reader->getAccountList('Metwurst');
		$this->assertEquals($expected, $result);

		// decoded as stdClass
		$reader->setDecode(true);
		$result = $reader->getAccountList('Metwurst');
		$this->assertEquals(jsonToStdClass($expected), $result);

		// decoded as assoc array
		$reader->setAssoc(true);
		$result = $reader->getAccountList('Metwurst');
		$this->assertEquals(jsonToAssoc($expected), $result);
	}
}
