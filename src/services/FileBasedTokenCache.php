<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\services;

use WMDE\ApiTestKit\TokenCache;

class FileBasedTokenCache implements TokenCache {

	private string $filename;

	public function __construct( string $filename ) {
		$this->filename = $filename;
	}

	public function getToken(): ?string {
		if ( !file_exists( $this->filename ) ) {
			return null;
		}

		try {
			$json = file_get_contents( $this->filename );
			$data = json_decode( $json, true );
		} catch ( \Exception $e ) {
			return null;
		}

		if ( ( new \DateTimeImmutable() )->getTimestamp() > $data['expiry'] ) {
			return null;
		}

		return $data['token'];
	}

	public function storeToken( string $token, int $expiry ): void {
		$data = json_encode( [
			'token' => $token,
			'expiry' => ( new \DateTimeImmutable() )->getTimestamp() + $expiry,
		] );

		file_put_contents( $this->filename, $data );
	}
}
