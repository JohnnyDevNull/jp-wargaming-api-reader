<?php
class jpWargamingReaderClansTest extends PHPUnit_Framework_TestCase
{
	protected function getReader()
	{
		return new jpWargamingReaderClans('03e3653b14d26e8136d5870a1512e3c4', 'EU');
	}

	public function test_requestTypes()
	{
		// GET
		$reader = $this->getReader();
		$reader->setGetMethod();
		$reader->getClansList('phpunit', '', 10);

		$this->assertEquals([
				'method' => 'GET',
				'url' => 'http://api.worldoftanks.eu/wgn/clans/list/?search=phpunit&limit=10&language=en&application_id=03e3653b14d26e8136d5870a1512e3c4',
				'query' => [
					'search' => 'phpunit',
					'limit' => 10,
					'language' => 'en',
					'application_id' => '03e3653b14d26e8136d5870a1512e3c4',
				],
				'response' => '{"status":"ok","meta":{"count":0,"total":0},"data":[]}',
			],
			$reader->getLastRequest()
		);

		// POST
		$reader = $this->getReader();
		$reader->setPostMethod();
		$reader->getClansList('phpunit', '', 10);

		$this->assertEquals([
				'method' => 'POST',
				'url' => 'http://api.worldoftanks.eu/wgn/clans/list/',
				'query' => [
					'search' => 'phpunit',
					'limit' => 10,
					'language' => 'en',
					'application_id' => '03e3653b14d26e8136d5870a1512e3c4',
				],
				'response' => '{"status":"ok","meta":{"count":0,"total":0},"data":[]}',
			],
			$reader->getLastRequest()
		);
	}

	public function test_returnTypes()
	{
		$expected = '{"status":"ok","meta":{"count":1,"total":1},"data":[{"tag":"TEST","name":"Test WG clan"}]}';

		// raw json
		$reader = $this->getReader();
		$result = $reader->getClansList('Test', ['name', 'tag'], 1);
		$this->assertEquals($expected, $result);

		// decoded as stdClass
		$reader->setDecode(true);
		$result = $reader->getClansList('Test', ['name', 'tag'], 1);
		$this->assertEquals(jsonToStdClass($expected), $result);

		// decoded as assoc array
		$reader->setAssoc(true);
		$result = $reader->getClansList('Test', ['name', 'tag'], 1);
		$this->assertEquals(jsonToAssoc($expected), $result);
	}
}
