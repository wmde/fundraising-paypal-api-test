<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$authenticator = $factory->newAuthenticator();
$orderCreator = $factory->newOrderCreator();
$url = $orderCreator->createOrderUrl( $authenticator->getToken() );

header( 'Location: ' . $url );
