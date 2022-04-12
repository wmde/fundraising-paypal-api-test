<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

class SubscriptionCreatorTest extends ApiTest {

	public function testOnCreateSubscriptionReturnsUrl(): void {
		$authenticator = $this->factory->newAuthenticator();
		$planCreator = $this->factory->newPlanCreator();
		$subscriptionCreator = $this->factory->newSubscriptionCreator();

		$token = $authenticator->getToken();
		$planId = $planCreator->createPlan( $token );
		$url = $subscriptionCreator->createSubscription( $token, $planId );

		$this->assertIsString( $url );
		$this->assertStringStartsWith( 'https://', $url );
		$this->assertStringNotContainsString( 'api-m', $url );
	}
}
