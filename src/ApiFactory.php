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

	private ?Authenticator $authenticator = null;

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

	public function getAuthenticator(): Authenticator {
		if($this->authenticator === null) {
			$this->authenticator = new Authenticator(
				new FileBasedTokenCache( __DIR__ . '/../token.json' ),
				$this->getClient(),
				Endpoints::AUTH,
				$this->config['client_id'],
				$this->config['secret']
			);
		}

		return $this->authenticator;
	}

	public function newOrderCreator(): OrderCreator {
		return new OrderCreator(
			$this->getClient(),
			Endpoints::ORDERS
		);
	}
}
