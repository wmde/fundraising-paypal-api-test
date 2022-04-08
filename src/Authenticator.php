<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

use GuzzleHttp\Client;

class Authenticator {

	private TokenCache $tokenCache;
	private Client $client;
	private string $authEndpoint;
	private string $clientId;
	private string $secret;

	public function __construct( TokenCache $tokenCache, Client $client, string $apiEndpoint, string $clientId, string $secret ) {
		$this->tokenCache = $tokenCache;
		$this->client = $client;
		$this->authEndpoint = $apiEndpoint;
		$this->clientId = $clientId;
		$this->secret = $secret;
	}

	public function getToken(): string {
		$token = $this->tokenCache->getToken();

		if ( $token !== null ) {
			return $token;
		}

		$response = $this->client->request( 'POST', $this->authEndpoint, [
			'auth' => [ $this->clientId, $this->secret ],
			'form_params' => [
				'grant_type' => 'client_credentials',
			]
		] );

		$data = json_decode( $response->getBody()->getContents(), true );

		$this->tokenCache->storeToken( $data['access_token'], $data['expires_in'] );

		return $data['access_token'];
	}
}
