<?php

declare( strict_types = 1 );

namespace WMDE\ApiTestKit;

interface WebhookLogger {

	public function getLog( string $id ): ?array;

	public function storeLog( string $id, array $data ): void;
}