<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\services;

use WMDE\ApiTestKit\Logger;

class FileBasedLogger implements Logger {

	private string $basePath;

	public function __construct( string $basePath ) {
		$this->basePath = $basePath;
	}

	public function getLog( string $filename ): ?array {
		if ( !file_exists( $this->filePath( $filename ) ) ) {
			return null;
		}

		try {
			$json = file_get_contents( $this->filePath( $filename ) );
			$data = json_decode( $json, true );
		} catch ( \Exception $e ) {
			return null;
		}

		return $data;
	}

	public function storeLog( string $filename, array $data ): void {
		$filename = $this->filePath( $filename );

		if ( file_exists( $filename ) ) {
			return;
		}

		file_put_contents( $filename, json_encode( $data ) );
	}

	private function filePath( string $filename ): string {
		return "{$this->basePath}/{$filename}.json";
	}
}
