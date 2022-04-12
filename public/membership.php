<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$authenticator = $factory->newAuthenticator();
$subscriptionCreator = $factory->newSubscriptionCreator();
$plans = $factory->newPlanIdStorage()->getPlanIds();

$plan = $_GET['plan'];
$amount = $_GET['amount'];

$url = $subscriptionCreator->createSubscription( $authenticator->getToken(), $plans[$plan], [
	'plan' => [
		'billing_cycles' => [
			[
				'sequence' => 1,
				'pricing_scheme' => [
					'fixed_price' => [
						'currency_code' => 'EUR',
						'value' => $amount
					]
				]
			]
		]
	]
] );

header( 'Location: ' . $url );