<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$logger = $factory->newLogger();

try {
	$body = file_get_contents( 'php://input' );
	$data = json_decode( $body, true );
	$logger->storeLog( $data['resource']['id'], $data );
} catch ( \Exception $e ) {
	// Don't do anything
}

echo 'OK';
exit();
