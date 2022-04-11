<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

/**
 * These tests are for making API calls to the live service
 */
class AuthenticatorTest extends ApiTest {

	public function testAuthenticatorReturnsToken(): void {
		$authenticator = $this->factory->newAuthenticator();

		$token = $authenticator->getToken();

		$this->assertIsString( $token );
		$this->assertNotEmpty( $token );
	}
}
