<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\services;

use WMDE\ApiTestKit\WebhookLogger;

class FileBasedWebhookLogger implements WebhookLogger {

	private string $basePath;

	public function __construct( string $basePath ) {
		$this->basePath = $basePath;
	}

	public function getLog( string $id ): ?array {
		if ( !file_exists( $this->filename( $id ) ) ) {
			return null;
		}

		try {
			$json = file_get_contents( $this->filename( $id ) );
			$data = json_decode( $json, true );
		} catch ( \Exception $e ) {
			return null;
		}

		return $data;
	}

	public function storeLog( string $id, array $data ): void {
		$filename = $this->filename( $id );

		if ( file_exists( $filename ) ) {
			return;
		}

		file_put_contents( $filename, json_encode( $data ) );
	}

	private function filename( string $id ): string {
		return "{$this->basePath}/{$id}.json";
	}
}
