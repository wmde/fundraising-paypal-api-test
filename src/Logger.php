<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

interface Logger {

	public function getLog( string $filename ): ?array;

	public function storeLog( string $filename, array $data ): void;
}