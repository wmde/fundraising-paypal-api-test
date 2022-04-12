<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

class ProductCreatorTest extends ApiTest {

	/**
	 * This needs to be run one time only to create a product for subscriptions
	 *
	 * @return void
	 */
	public function testCreateProduct(): void {
		$this->markTestSkipped();

		$authenticator = $this->factory->newAuthenticator();
		$productCreator = $this->factory->newProductCreator();

		$data = $productCreator->createProduct( $authenticator->getToken() );

		print_r( $data );
	}

}
