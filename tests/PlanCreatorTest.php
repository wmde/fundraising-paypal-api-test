<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\Tests;

class PlanCreatorTest extends ApiTest {

	public function testOnCreatePlanReturnsPlanId(): void {
		$authenticator = $this->factory->newAuthenticator();
		$planCreator = $this->factory->newPlanCreator();

		$planId = $planCreator->createPlan( $authenticator->getToken() );

		$this->assertIsString( $planId );
		$this->assertStringStartsWith( 'P-', $planId );
	}
}
