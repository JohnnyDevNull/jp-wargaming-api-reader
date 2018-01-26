<?php
use PHPUnit\Framework\TestCase;

class jpWargamingReaderWotTest extends TestCase
{
	protected function getReader()
	{
		return new jpWargamingReaderWot('03e3653b14d26e8136d5870a1512e3c4', 'EU');
	}

	public function test_requestTypes()
	{
		// GET
		$reader = $this->getReader();
		$reader->setGetMethod();
		$reader->getAccountList('Metwurst', '', 'exact');

		$this->assertEquals([
				'method' => 'GET',
				'url' => 'http://api.worldoftanks.eu/wot/account/list/?search=Metwurst&type=exact&limit=100&language=en&application_id=03e3653b14d26e8136d5870a1512e3c4',
				'query' => [
					'search' => 'Metwurst',
					'type' => 'exact',
					'limit' => 100,
					'language' => 'en',
					'application_id' => '03e3653b14d26e8136d5870a1512e3c4',
				],
				'response' => '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}',
			],
			$reader->getLastRequest()
		);

		// POST
		$reader = $this->getReader();
		$reader->setPostMethod();
		$reader->getAccountList('Metwurst', '', 'exact');

		$this->assertEquals([
				'method' => 'POST',
				'url' => 'http://api.worldoftanks.eu/wot/account/list/',
				'query' => [
					'search' => 'Metwurst',
					'type' => 'exact',
					'limit' => 100,
					'language' => 'en',
					'application_id' => '03e3653b14d26e8136d5870a1512e3c4',
				],
				'response' => '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}',
			],
			$reader->getLastRequest()
		);
	}

	public function test_returnTypes()
	{
		$expected = '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}';

		// raw json
		$reader = $this->getReader();
		$result = $reader->getAccountList('Metwurst', '', 'exact');
		$this->assertEquals($expected, $result);

		// decoded as stdClass
		$reader->setDecode(true);
		$result = $reader->getAccountList('Metwurst', '', 'exact');
		$this->assertEquals(jsonToStdClass($expected), $result);

		// decoded as assoc array
		$reader->setAssoc(true);
		$result = $reader->getAccountList('Metwurst', '', 'exact');
		$this->assertEquals(jsonToAssoc($expected), $result);
	}

	public function test_getAccountList()
	{
		// with fields param "nickname"
		$expected = '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst"}]}';

		$reader = $this->getReader();
		$result = $reader->getAccountList('Metwurst', 'nickname', 'exact');
		$this->assertEquals($expected, $result);

		// with fields param "account_id"
		$expected = '{"status":"ok","meta":{"count":1},"data":[{"account_id":500554376}]}';

		$reader = $this->getReader();
		$result = $reader->getAccountList('Metwurst', 'account_id', 'exact');
		$this->assertEquals($expected, $result);

		// with both fields param as array list
		$expected = '{"status":"ok","meta":{"count":1},"data":[{"nickname":"Metwurst","account_id":500554376}]}';

		$reader = $this->getReader();
		$result = $reader->getAccountList('Metwurst', ['nickname', 'account_id'], 'exact');
		$this->assertEquals($expected, $result);
	}

	public function test_getAccountInfo()
	{
		// with single fields param
		$expected = '{"status":"ok","meta":{"count":1},"data":{"500554376":{"nickname":"Metwurst"}}}';

		$reader = $this->getReader();
		$result = $reader->getAccountInfo('500554376', 'nickname');
		$this->assertEquals($expected, $result);

		// with multiple fields param
		$expected = '{"status":"ok","meta":{"count":1},"data":{"500554376":{"nickname":"Metwurst","account_id":500554376}}}';

		$reader = $this->getReader();
		$result = $reader->getAccountInfo('500554376', ['account_id', 'nickname']);
		$this->assertEquals($expected, $result);
	}
}
