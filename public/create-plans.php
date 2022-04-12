<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$token = $factory->newAuthenticator()->getToken();
$planCreator = $factory->newPlanCreator();
$planIdStorage = $factory->newPlanIdStorage();

$plans = [
	'membership-daily' => [
		'product_id' => 'MEMBERSHIP',
		'name' => 'Daily Membership to Wikimedia Deutschland',
		'billing_cycles' => [
			[
				'frequency' => [
					'interval_unit' => 'DAY',
					'interval_count' => 1
				],
			],
		]
	],
	'membership-monthly' => [
		'product_id' => 'MEMBERSHIP',
		'name' => 'Monthly Membership to Wikimedia Deutschland',
		'billing_cycles' => [
			[
				'frequency' => [
					'interval_unit' => 'MONTH',
					'interval_count' => 1
				],
			],
		]
	],
	'membership-quarterly' => [
		'product_id' => 'MEMBERSHIP',
		'name' => 'Quarterly Membership to Wikimedia Deutschland',
		'billing_cycles' => [
			[
				'frequency' => [
					'interval_unit' => 'MONTH',
					'interval_count' => 3
				],
			],
		]
	],
	'membership-twice-yearly' => [
		'product_id' => 'MEMBERSHIP',
		'name' => 'Twice Yearly Membership to Wikimedia Deutschland',
		'billing_cycles' => [
			[
				'frequency' => [
					'interval_unit' => 'MONTH',
					'interval_count' => 6
				],
			],
		]
	],
	'membership-yearly' => [
		'product_id' => 'MEMBERSHIP',
		'name' => 'Yearly Membership to Wikimedia Deutschland',
		'billing_cycles' => [
			[
				'frequency' => [
					'interval_unit' => 'YEAR',
					'interval_count' => 1
				],
			],
		]
	]
];

$planIds = $planIdStorage->getPlanIds();

foreach ( $plans as $planName => $data ) {
	if ( isset( $planIds[$planName] ) ) {
		continue;
	}

	$planId = $planCreator->createPlan( $token, $data );
	if ( $planId ) {
		$planIds[$planName] = $planId;
	}
}

$planIdStorage->savePlanIds( $planIds );

echo '<pre>';
print_r( $planIds );
echo '</pre>';
