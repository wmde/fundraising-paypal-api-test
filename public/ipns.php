<?php

declare( strict_types = 1 );

use WMDE\ApiTestKit\ApiFactory;

/**
 * @var ApiFactory $factory
 */
$factory = include_once __DIR__ . '/../src/bootstrap.php';
$logger = $factory->newIPNLogger();

try {
	$logger->storeLog( strval( ( new \DateTimeImmutable() )->getTimestamp() ), $_POST );
} catch ( \Exception $e ) {
	// Don't do anything
}

echo 'OK';
exit();
