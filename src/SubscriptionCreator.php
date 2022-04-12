<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

class SubscriptionCreator {

	private Client $client;
	private string $endpoint;
	private string $baseUrl;

	public function __construct( Client $client, string $endpoint, string $baseUrl ) {
		$this->client = $client;
		$this->endpoint = $endpoint;
		$this->baseUrl = $baseUrl;
	}

	public function createSubscription( string $token, string $planId, array $data = [] ): string {
		$response = $this->client->request( 'POST', $this->endpoint, [
			'headers' => [
				'Authorization' => "Bearer {$token}"
			],
			'http_errors' => false,
			'json' => array_replace_recursive( [
				'plan_id' => $planId,
				'start_time' => (new \DateTimeImmutable( '+1 month' ))->format( 'Y-m-d\TH:i:s\Z' ),
				'custom_id' => uniqid( 'MEMBERSHIP-' )
			], $data )
		] );

		$data = json_decode( $response->getBody()->getContents(), true );

		return $data['links'][0]['href'] . '?return=' . $this->baseUrl . '/confirmation.php?id=' . $data['id'];
	}

}
