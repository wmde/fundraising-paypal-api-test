<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

class OrderCreator {

	private Client $client;
	private string $token;
	private string $endpoint;

	public function __construct( Client $client, string $token, string $endpoint ) {
		$this->client = $client;
		$this->token = $token;
		$this->endpoint = $endpoint;
	}


	public function createOrderUrl( array $data = [] ): string {
		$response = $this->client->request( 'POST', $this->endpoint, [
			'headers' => [
				'Authorization' => "Bearer {$this->token}"
			],
			'json' => array_merge( [
				'intent' => 'CAPTURE',
				'status' => 'CREATED',
				'purchase_units' => [ [
					'reference_id' => 'DONATION-001',
					'amount' => [
						'currency_code' => 'EUR',
						'value' => '1000'
					]
				] ]
			], $data )
		] );

		$data = json_decode( $response->getBody()->getContents(), true );

		return $data['links'][1]['href'];
	}
}
