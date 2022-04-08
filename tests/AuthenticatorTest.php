<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

use Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;
use WMDE\ApiTestKit\ApiFactory;;

/**
 * These tests are for making API calls to the live service
 */
class AuthenticatorTest extends TestCase {

	private ?ApiFactory $factory = null;

	public function SetUp(): void {
		if ( $this->factory === null ) {
			$dotenv = Dotenv::createImmutable( __DIR__ . '/../' );
			$dotenv->safeLoad();

			$this->factory = new ApiFactory( [
				'client_id' => $_ENV['CLIENT_ID'],
				'secret' => $_ENV['SECRET']
			] );
		}
	}

	public function testAuthenticatorReturnsToken(): void {
		$authenticator = $this->factory->newAuthenticator();

		$token = $authenticator->getToken();

		$this->assertIsString( $token );
		$this->assertNotEmpty( $token );
	}
}
