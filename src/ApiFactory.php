<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;
use WMDE\ApiTestKit\services\FileBasedPlanIdStorage;
use WMDE\ApiTestKit\services\FileBasedTokenCache;
use WMDE\ApiTestKit\services\FileBasedLogger;

class ApiFactory {

	/**
	 * @var array{client_id: string, secret: string, base_url: string}
	 */
	private array $config;
	private ?Client $client = null;

	/**
	 * @param array{client_id: string, secret: string, base_url: string} $config
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
			$this->getClient(),
			Endpoints::AUTH,
			$this->config['client_id'],
			$this->config['secret']
		);
	}

	public function newOrderCreator(): OrderCreator {
		return new OrderCreator(
			$this->getClient(),
			Endpoints::ORDERS,
			$this->config['base_url']
		);
	}

	public function newPlanCreator(): PlanCreator {
		return new PlanCreator(
			$this->getClient(),
			Endpoints::PLANS
		);
	}

	public function newProductCreator(): ProductCreator {
		return new ProductCreator(
			$this->getClient(),
			Endpoints::PRODUCTS
		);
	}

	public function newSubscriptionCreator(): SubscriptionCreator {
		return new SubscriptionCreator(
			$this->getClient(),
			Endpoints::SUBSCRIPTIONS,
			$this->config['base_url']
		);
	}

	public function newWebhookLogger(): Logger {
		return new FileBasedLogger( __DIR__ . '/../logs/webhooks' );
	}

	public function newIPNLogger(): Logger {
		return new FileBasedLogger( __DIR__ . '/../logs/ipns' );
	}

	public function newPlanIdStorage(): PlanIdStorage {
		return new FileBasedPlanIdStorage( __DIR__ . '/../plans.json' );
	}
}
