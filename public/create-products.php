<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$token = $factory->newAuthenticator()->getToken();
$productCreator = $factory->newProductCreator();

$products = [
	'MEMBERSHIP' => 'Membership to Wikimedia Deutschland',
	'DONATION' => 'Donation to Wikimedia Deutschland'
];

$results = [];
foreach ( $products as $productId => $name ) {
	$results[] = $productCreator->createProduct( $token, [
		'id' => $productId,
		'name' => $name
	] );
}

echo '<pre>';
print_r( $results );
echo '</pre>';
