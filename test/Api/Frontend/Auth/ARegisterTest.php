<?php

declare(strict_types=1);
/**
 * Multi-user mall
 *
 * @link     https://www.doubi.site
 * @document https://doc.doubi.site
 * @contact  8257796@qq.com
 */
namespace HyperfTest\Api\Frontend\Auth;

use Hyperf\Testing\Client;
use HyperfTest\HttpTestCase;

class ARegisterTest extends HttpTestCase
{
	/**
	 * @var Client
	 */
	protected $client;

	public function __construct($name = null, array $data = [], $dataName = '')
	{
		parent::__construct($name, $data, $dataName);
		$this->client = make(Client::class);
	}

	public function testFrontendRegister()
	{
		$this->assertTrue(true);

		echo 'register';
		$this->assertTrue(is_string($this->get('/')));
	}
}
