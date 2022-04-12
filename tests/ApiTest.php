<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use WMDE\ApiTestKit\ApiFactory;

class ApiTest extends TestCase {

	protected ?ApiFactory $factory = null;

	public function SetUp(): void {
		if ( $this->factory === null ) {
			$dotenv = Dotenv::createImmutable( __DIR__ . '/../' );
			$dotenv->safeLoad();

			$this->factory = new ApiFactory( [
				'client_id' => $_ENV['CLIENT_ID'],
				'secret' => $_ENV['SECRET'],
				'base_url' => $_ENV['BASE_URL']
			] );
		}
	}
}
