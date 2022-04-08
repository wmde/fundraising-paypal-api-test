<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;
use WMDE\ApiTestKit\services\FileBasedTokenCache;

class ApiFactory {

	/**
	 * @var array{client_id: string, secret: string}
	 */
	private array $config;
	private ?Client $client = null;

	/**
	 * @param array{client_id: string, secret: string} $config
	 */
	public function __construct( array $config ) {
		$this->config = $config;
	}

	private function getClient(): Client {
		if ( $this->client === null ) {
			$this->client = new Client();
		}

		return $this->client;
	}

	public function newAuthenticator(): Authenticator {
		return new Authenticator(
			new FileBasedTokenCache( __DIR__ . '/../token.json' ),
			Endpoints::AUTH,
			$this->config['client_id'],
			$this->config['secret'],
			$this->getClient()
		);
	}
}
