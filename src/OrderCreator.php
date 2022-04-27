<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

class OrderCreator {

	private Client $client;
	private string $endpoint;
	private string $baseUrl;

	public function __construct( Client $client, string $endpoint, string $baseUrl ) {
		$this->client = $client;
		$this->endpoint = $endpoint;
		$this->baseUrl = $baseUrl;
	}

	public function createOrderUrl( string $token, array $data = [] ): string {
		$response = $this->client->request( 'POST', $this->endpoint, [
			'headers' => [
				'Authorization' => "Bearer {$token}"
			],
			'json' => array_merge( [
				'intent' => 'CAPTURE',
				'status' => 'CREATED',
				'purchase_units' => [
					[
						'reference_id' => uniqid( 'DONATION-' ),
						'amount' => [
							'currency_code' => 'EUR',
							'value' => '1000'
						]
					]
				],
				'return_url' => $this->baseUrl . '/confirmation.php?id=' . $data['id']
			], $data )
		] );

		$data = json_decode( $response->getBody()->getContents(), true );

		return $data['links'][1]['href'];
	}
}
