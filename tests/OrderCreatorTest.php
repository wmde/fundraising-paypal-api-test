<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

class OrderCreatorTest extends ApiTest {

	public function testOnCreateOrderReturnsUrl(): void {
		$orderCreator = $this->factory->newOrderCreator();

		$url = $orderCreator->createOrderUrl();
		$this->assertIsString( $url );
		$this->assertStringStartsWith( 'https://', $url );
	}

}
