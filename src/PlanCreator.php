<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

/**
 * Subscriptions require a plan, and ours are really custom
 * meaning we need to create them on the fly
 */
class PlanCreator {

	private Client $client;
	private string $endpoint;

	public function __construct( Client $client, string $endpoint ) {
		$this->client = $client;
		$this->endpoint = $endpoint;
	}

	public function createPlan( string $token, array $data = [] ): ?string {
		$response = $this->client->request( 'POST', $this->endpoint, [
			'headers' => [
				'Authorization' => "Bearer {$token}"
			],
			'http_errors' => false,
			'json' => array_replace_recursive( [
				'product_id' => 'MEMBERSHIP',
				'name' => 'Membership to Wikimedia Deutschland',
				'billing_cycles' => [
					[
						'frequency' => [
							'interval_unit' => 'MONTH',
							'interval_count' => 1
						],
						'tenure_type' => 'REGULAR',
						'sequence' => 1,
						'total_cycles' => 0,
						'pricing_scheme' => [
							'fixed_price' => [
								'value' => 1,
								'currency_code' => 'EUR'
							]
						]
					]
				],
				'payment_preferences' => [
					'auto_bill_outstanding' => true,
					'payment_failure_threshold' => 3
				]
			], $data )
		] );

		$data = json_decode( $response->getBody()->getContents(), true );

		return $data['id'] ?? null;
	}
}
