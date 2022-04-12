<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit\services;

use WMDE\ApiTestKit\PlanIdStorage;

class FileBasedPlanIdStorage implements PlanIdStorage {

	private string $filename;

	public function __construct( string $filename ) {
		$this->filename = $filename;
	}

	public function getPlanIds(): array {
		if ( !file_exists( $this->filename ) ) {
			return [];
		}

		try {
			$json = file_get_contents( $this->filename );
			$data = json_decode( $json, true );
		}
		catch ( \Exception $e ) {
			return [];
		}

		return $data;
	}

	public function savePlanIds( array $planIds ): void {
		file_put_contents( $this->filename, json_encode( $planIds ) );
	}
}
