<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

class OrderCreatorTest extends ApiTest {

	public function testOnCreateOrderReturnsUrl(): void {
		$authenticator = $this->factory->newAuthenticator();
		$orderCreator = $this->factory->newOrderCreator();

		$url = $orderCreator->createOrderUrl( $authenticator->getToken() );

		$this->assertIsString( $url );
		$this->assertStringStartsWith( 'https://', $url );
		$this->assertStringNotContainsString( 'api-m', $url );
	}

}
