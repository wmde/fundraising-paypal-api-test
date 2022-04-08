<?php

declare( strict_types = 1 );

use Dotenv\Dotenv;
use WMDE\ApiTestKit\ApiFactory;

include_once __DIR__ . '/../vendor/autoload.php';

$dotenv = Dotenv::createImmutable( __DIR__ . '/../' );
$dotenv->safeLoad();

return new ApiFactory( [
	'client_id' => $_ENV['CLIENT_ID'],
	'secret' => $_ENV['SECRET']
] );
