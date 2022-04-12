<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

/**
 * Subscription plans need a product ID so this needs to
 * be run one time to create one
 */
class ProductCreator {

	private Client $client;
	private string $endpoint;

	public function __construct( Client $client, string $endpoint ) {
		$this->client = $client;
		$this->endpoint = $endpoint;
	}

	public function createProduct( string $token, array $data = [] ): array {
		$response = $this->client->request( 'POST', $this->endpoint, [
			'headers' => [
				'Authorization' => "Bearer {$token}"
			],
			'http_errors' => false,
			'json' => array_merge( [
				'id' => 'MEMBERSHIP',
				'type' => 'SERVICE',
				'name' => 'Membership to Wikimedia Deutschland',
				'description' => 'Ihre Spende für freies Wissen',
				'category' => 'NONPROFIT',
				'image_url' => 'https://spenden.wikimedia.de/skins/laika/images/logo-horizontal-wikimedia.svg',
				'home_url' => 'https://spenden.wikimedia.de'
			], $data )
		] );

		return json_decode( $response->getBody()->getContents(), true );
	}
}
